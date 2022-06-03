<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CrawlerFetchService
{

    /**
     * 爬取資料
     * @param String $url
     *
     * @return void
     */
    public function fetch($url)
    {
        $result = collect();
        $result->url = strtok($url, '?');

        $httpClient = Client::createChromeClient(base_path('drivers/chromedriver'));
        $response = $httpClient->get($url);
        // 螢幕截圖
        $time = now()->timestamp;
        $result->list_screenshot = "storage/screenshot/list/${time}.jpg";
        $response->takeScreenshot($result->list_screenshot);

        $crawler = $response->getCrawler();
        // 列表標題
        $result->list_title = $crawler->filter('h1.page-header')->text();

        // 上一頁
        $prev = $crawler->filter('li.prev a');
        $result->prev = $prev->count() > 0 ? url()->current() . '?url=' . $prev->link()->getUri() : null;

        // 下一頁
        $next = $crawler->filter('li.next a');
        $result->next = $next->count() > 0 ? url()->current() . '?url=' . $next->link()->getUri() : null;

        // 所有內頁連結
        $pageUrls = $crawler->filter('p.title a')
                            ->each(function ($node) {
                                return $node->link()->getUri();
                            });

        $result->pages = collect();
        foreach ($pageUrls as $key => $link) {
            $pageData = collect();
            // 進入內頁
            $pageData->url = $link;
            // 點擊進內頁
            $pageResponse = $httpClient->get($link);
            // 內頁 HTML
            $html = $httpClient->getCrawler()->html();
            $crawler = new Crawler($html);

            // 內頁截圖
            $time = now()->timestamp;
            $pageData->screenshot = "storage/screenshot/page/${time}.jpg";
            $pageResponse->takeScreenshot($pageData->screenshot);

            // 爬各欄位資料
            $title = $crawler->filter('h1.page-header');
            $image = $crawler->filter('.img-wrapper img');
            $description = $crawler->filter('div.content-summary p');
            $body = $crawler->filter('article');
            $createAt = $crawler->filter('span.created');

            $pageData->title = $title->count() > 0 ? $title->text() : null;
            $pageData->image = $image->count() > 0 ? $image->image()->getUri() : null;
            $pageData->description = $description->count() > 0 ? $description->text() : null;
            $pageData->body = $body->count() > 0 ? $body->html() : null;
            $pageData->create_at = $createAt->count() > 0 ? $createAt->text() : null;
            $result->pages->push($pageData);
            // 返回上一頁
            $httpClient->back();
        }

        // 關閉瀏覽器
        $httpClient->close();

        return $result;
    }
}

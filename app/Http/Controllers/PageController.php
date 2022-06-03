<?php

namespace App\Http\Controllers;

use App\Services\CrawlerFetchService;
use Illuminate\Http\Request;
use Exception;

class PageController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!$request->url) {
                throw new Exception("Error url");
            }

            $crawl = new CrawlerFetchService;
            $pages = $crawl->fetch($request->url);

            return view('list', compact('pages'));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

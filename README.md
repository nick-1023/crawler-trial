## 說明
1. 主要使用 [symfony/panther](https://github.com/symfony/panther) 套件來執行爬蟲。
2. 爬取 iThome [最新的文章](https://www.ithome.com.tw/latest)頁面，尚未得到您的回覆，所以目前是固定的。
3. 螢幕截圖將存放在 ```public/storage/screenshot/```中。
4. React 的部分我並不熟悉，對於 Vue 比較熟悉一些，但由於時間的關係，這次前端的部分，我只有使用非常簡單的寫法，使用 Blade，並使用 Bootstrap 5 框架來快速建立畫面。
5. 很抱歉，由於沒有太多的時間，所以這次就沒有額外寫 Unit Test，但平常都會使用。
6. 分頁與篩選功能的部分，如果有將資料存入資料庫，就不是很難的功能，不過很抱歉，沒能等到您的回覆，所以這次就沒有執行這兩項功能。

## 安裝步驟
1. 執行 composer install。
```bash
composer install
```
2. 複製 .env.example 檔案，並改為 .env。
3. 請依照你的 Chrome 版本下載 相對應的 [ChromeDriver](https://chromedriver.chromium.org/downloads) 版本，並存放置 drivers 資料夾中。

## 使用說明
1. 開啟站台，並點選送出按鈕。
2. 將會看到 iThome 最新文章列表，包含列表標題、截圖與每一篇文章的圖片、標題、連結、建立日期、簡述、文章截圖。
3. 點選看更多，將會開啟內頁文章資訊，上方為文章標題，左側為文章連結、建立日期、文章截圖，右側為文章的詳細內容。
4. 可點選上一頁或下一頁，重新爬取上一頁或下一頁資料。

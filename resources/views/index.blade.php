<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crawler trial</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <style>
            .form {
                width: 100%;
                max-width: 500px;
                padding: 15px;
                margin: auto;
            }
        </style>

    </head>

    <body class="text-center">
        <div class="form">
            <h1 class="h3 m-3 fw-normal">請輸入網址</h1>
            <form action="{{ action('PageController@index') }}" method="get">
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="url" name="url" value="https://www.ithome.com.tw/latest/" readonly>
                    <label for="url">網址</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">送出</button>
            </form>
        </div>
    </body>
</html>

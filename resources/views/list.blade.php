<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crawler trial</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
        <style>
            body {
                background-color: #e9e8e8;
            }
            .content, .page {
                background-color: #fff;
            }
            img {
                width: 100%;
            }
            #modal-body img {
                width: auto;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
                    <img src="{{ url($pages->list_screenshot) }}" title="列表截圖" alt="列表截圖" />
                </div>
                <div class="col-12 mb-2">
                    <h1>{{ $pages->list_title }}</h1>
                </div>
            </div>
            <div class="row content">
                @foreach ($pages->pages as $page)
                    <div class="col-4 mb-4 p-4 item">
                        <div class="mb-3">
                            <img class="image" src="{{ $page->image }}" />
                        </div>
                        <div class="mb-2">
                            <h2 class="title">{{ $page->title }}</h2>
                            <p class="url">
                                Url :
                                <a href="{{ $page->url }}" target="_blank" rel="noreferrer noopener">
                                    {{ $page->url }}
                                </a>
                            </p>
                            <p class="create_at">Create at : {{ $page->create_at }}</p>
                        </div>
                        <p class="description">{{ $page->description }}</p>
                        <div class="mb-2 screenshot">
                            <img src="{{ url($page->screenshot) }}" title="內頁截圖" alt="內頁截圖" />
                        </div>
                        <div class="body" style="display: none">
                            {!! $page->body !!}
                        </div>
                        <button class="n-more w-50 btn btn-sm btn-primary" onclick="openModal(this)">Read More</button>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center page mt-1 p-5">
                <div class="col-2">
                    <a class="btn btn-info" href="{{ $pages->prev ?? 'javascript:;' }}">上一頁</a>
                    <a class="btn btn-info" href="{{ $pages->next ?? 'javascript:;'}}">下一頁</a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title" class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <p id="modal-url"></p>
                                <p id="modal-create-at"></p>
                                <div id="modal-screenshot"></div>
                            </div>
                            <div id="modal-body" class="col-9"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const myModal = new bootstrap.Modal(document.getElementById('detailModal'));
            function openModal(element) {
                let item = element.parentElement;
                let title = item.getElementsByClassName('title')[0].innerHTML;
                let screenshot = item.getElementsByClassName('screenshot')[0].innerHTML;
                let body = item.getElementsByClassName('body')[0].innerHTML;
                let createAt = item.getElementsByClassName('create_at')[0].innerHTML;
                let url = item.getElementsByClassName('url')[0].innerHTML;

                document.getElementById('modal-title').innerHTML = title;
                document.getElementById('modal-screenshot').innerHTML = screenshot;
                document.getElementById('modal-body').innerHTML = body;
                document.getElementById('modal-create-at').innerHTML = createAt;
                document.getElementById('modal-url').innerHTML = url;

                myModal.show();
            }
        </script>
    </body>
</html>

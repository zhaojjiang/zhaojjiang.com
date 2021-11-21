<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $content->title }}</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
        .device-toc-border {
            border-bottom: grey 1px solid;
        }
        @media (min-width: 992px) {
            .device-position-fixed {
                position: fixed !important;
            }
            .device-toc-border {
                border-bottom: unset;
                border-right: grey 1px solid;
            }
            .w-lg-20 {
                width: 20%;
            }
            .offset-lg-w20 {
                margin-left: 20%;
            }
            .w-lg-75 {
                width: 75%;
            }
            .offset-lg-w95 {
                margin-left: 95%;
            }
            .w-lg-5 {
                width: 5%;
            }
        }
    </style>
</head>
<body>
<div>
    <div class="d-lg-flex">
        <div id="toc-box" class="col-lg-3 h-100 overflow-auto device-position-fixed device-toc-border w-lg-20">
            <div id="toc-container">

            </div>
        </div>

        <div id="content-box" class="col-lg-8 offset-lg-3 h-100 w-lg-75 offset-lg-w20">
            <textarea id="data_content_md" style="display: none">{{ $content->content_md }}</textarea>
            <div id="content-container">
                <h1>{{ $content->title }}</h1>

            </div>
        </div>

        <div class="col-lg-1 offset-lg-11 position-fixed h-100 w-lg-5 offset-lg-w95">
            <a class="btn btn-primary btn-sm" href="{{ route('content.index') }}">List</a>
            <a class="btn btn-primary btn-sm" href="{{ route('content.edit', $content) }}">Edit</a>
            <a class="btn btn-primary btn-sm" href="{{ route('content.create') }}">New</a>
            <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(window.top)">Top</div>
            <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(0, document.documentElement.scrollHeight)">End</div>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('assets/editor.md/editormd.min.js') }}"></script>
<script src="{{ asset('assets/editor.md/lib/marked.min.js') }}"></script>
<script src="{{ asset('assets/editor.md/lib/prettify.min.js') }}"></script>
<script>
    $(function () {
        let view = editormd.markdownToHTML('content-container', {
            markdown: $('#data_content_md').text(),
            tocContainer: '#toc-container',
            tocTitle: '目录',
            tocDropdown: true,
            tocStartLevel: 2,
        });
    });
</script>
</html>

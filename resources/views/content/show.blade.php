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
        #toc-container {
            padding: 18px;
        }
        .device-toc-border {
            border-bottom: grey 1px solid;
        }
        @media (min-width: 997px) {
            .device-position-fixed {
                position: fixed !important;
            }
            .device-toc-border {
                border-bottom: unset;
                border-right: grey 1px solid;
            }
        }
    </style>
</head>
<body>
<div>
    <div class="d-lg-flex">
        <div id="toc-container" class="col-lg-3 h-100 overflow-auto device-position-fixed device-toc-border">
            <div id="toc-view">

            </div>
        </div>
        <div id="content-container" class="offset-lg-3 h-100">
            <div id="content-view">
                <h1>{{ $content->title }}</h1>
            </div>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('assets/editor.md/editormd.min.js') }}"></script>
<script src="{{ asset('assets/editor.md/lib/marked.min.js') }}"></script>
<script src="{{ asset('assets/editor.md/lib/prettify.min.js') }}"></script>
<script>
    $(function () {
        let view = editormd.markdownToHTML('content-view', {
            markdown: '{{ js_text($content->content_md) }}',
            tocContainer: '#toc-view',
            tocTitle: '目录',
            tocDropdown: true,
            tocStartLevel: 2,
        });
    });
</script>
</html>

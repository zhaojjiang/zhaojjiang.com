<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ !$is_edit ? 'New' : 'Edit' }}</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
        .toc-border {
            border-right: grey 1px solid;
        }
        .w-20 {
            width: 20%;
        }
        .offset-w20 {
            margin-left: 20%;
        }
        .w-75 {
            width: 75%;
        }
        .w-5 {
            width: 5%;
        }
        .offset-w95 {
            margin-left: 95%;
        }
    </style>
</head>
<body>
<div class="d-flex">
    @include('shared._messages')

    <div id="toc-box" class="col-3 h-100 overflow-auto position-fixed toc-border w-20">
        <div id="toc-container">

        </div>
    </div>

    <form action="{{ !$is_edit ? route('content.store') : route('content.update', $content) }}" method="POST"
          class="offset-3 col-8 offset-w20 w-75">
        {{ $is_edit ? method_field('PUT') : '' }}
        {{ csrf_field() }}
        <div class="row">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon">标题</span>
                <input type="text" id="title" name="title" class="form-control" aria-describedby="basic-addon"
                       autocomplete="off" value="{{ $is_edit ? $content->title : old('title') }}">
            </div>
        </div>
        <div id="editor-md" style="width: 100%; min-height: 500px;">
            <label for="content"></label>
            <textarea id="content"></textarea>
        </div>

        <input type="submit" class="btn btn-primary w-100" value="保存">
    </form>

    <div class="col-1 offset-11 position-fixed h-100 w-5 offset-w95" style="border-left: grey 1px solid">
        <a class="btn btn-primary btn-sm" href="{{ route('content.index') }}">List</a>
        @if($is_edit)
        <a class="btn btn-primary btn-sm" href="{{ route('content.show', $content) }}">Show</a>
        @endif
        <a class="btn btn-primary btn-sm" href="{{ route('content.create') }}">New</a>
        <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(window.top)">Top</div>
        <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(0, document.documentElement.scrollHeight)">End</div>
    </div>
</div>
</body>

<script src="{{ asset('assets/editor.md/editormd.min.js') }}"></script>
<script>
    $(function () {
        let editor = editormd('editor-md', {
            path: '/assets/editor.md/lib/',
            markdown: '{{ !$is_edit ? js_text(old('content_md')) : js_text($content->content_md) }}',
            saveHTMLToTextarea: true,
            name: 'content_md',
            htmlName: 'content_html',
            textarea: {
                html: 'content-html',
                markdown: 'content-md',
            },
            tocContainer: '#toc-container',
            tocStartLevel: 2,
        });
    });
</script>
</html>

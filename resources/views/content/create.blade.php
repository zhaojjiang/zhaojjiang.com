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
</head>
<body>
<div class="container mb-3 mt-3">
    @include('shared._messages')
    <form action="{{ !$is_edit ? route('content.store') : route('content.update', $content) }}" method="POST">
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
</div>
</body>

<script src="{{ asset('assets/editor.md/editormd.min.js') }}"></script>
<script>
    $(function () {
        let editor = editormd('editor-md', {
            autoHeight: true,
            path: '/assets/editor.md/lib/',
            markdown: '{{ !$is_edit ? js_text(old('content_md')) : js_text($content->content_md) }}',
            saveHTMLToTextarea: true,
            name: 'content_md',
            htmlName: 'content_html',
            textarea: {
                html: 'content-html',
                markdown: 'content-md',
            },
            tocStartLevel: 2,
        });
    });
</script>
</html>

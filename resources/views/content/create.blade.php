@extends('layouts.layout')

@section('title', !$is_edit ? 'New' : 'Edit')

@section('style')
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
        #page-header, #page-footer {
            width: 80%;
            margin-left: 20%;
        }
    </style>
@endsection

@section('sidebar')
    <div id="toc-box" class="col-3 h-100 overflow-auto position-fixed toc-border w-20">
        <div id="toc-container">

        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex">
        <form action="{{ !$is_edit ? route('content.store') : route('content.update', $content) }}" method="POST"
              class="offset-3 col-8 offset-w20 w-75">
            {{ $is_edit ? method_field('PUT') : '' }}
            {{ csrf_field() }}

            @include('shared._messages')

            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon">标题</span>
                    <input type="text" id="title" name="title" class="form-control" aria-describedby="basic-addon"
                           autocomplete="off" value="{{ $is_edit ? $content->title : old('title') }}">
                </div>
            </div>

            <textarea id="data_content_md" style="display: none">{{ !$is_edit ? old('content_id') :  $content->content_md }}</textarea>
            <div id="editor-md" style="width: 100%; min-height: 500px;">

            </div>

            <input type="submit" class="btn btn-primary w-100" value="保存">
        </form>

        <div class="col-1 offset-11 position-fixed h-100 w-5 offset-w95">
            @if($is_edit)
            <a class="btn btn-primary btn-sm" href="{{ route('content.show', $content) }}">Show</a>
            @endif
            <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(window.top)">Top</div>
            <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(0, document.documentElement.scrollHeight)">End</div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/editor.md/editormd.js') }}"></script>
<script>
    $(function () {
        let editor = editormd('editor-md', {
            height: '1000px',
            path: '/assets/editor.md/lib/',
            markdown: $('#data_content_md').text(),
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
@endsection

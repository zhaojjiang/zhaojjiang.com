@extends('layouts.layout')

@section('title', !$is_edit ? 'NewPage' : 'EditPage')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
    </style>
@endsection

@section('content-class', 'col-12')
@section('content')
    <div class="d-flex container">
        <form action="{{ !$is_edit ? route('page.store') : route('page.update', $page->name) }}" method="POST"
              class="col-11">
            {{ $is_edit ? method_field('PUT') : '' }}
            {{ csrf_field() }}

            @include('shared._messages')

            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon">标题</span>
                    <input type="text" id="title" name="title" class="form-control" aria-describedby="basic-addon"
                           autocomplete="off" value="{{ $is_edit ? $page->title : old('title') }}">
                </div>
            </div>

            <textarea id="data_content_md" style="display: none">{{ !$is_edit ? old('content_md') :  $page->content_md }}</textarea>
            <div id="editor-md" style="width: 100%; min-height: 500px;">

            </div>

            <input type="submit" class="btn btn-primary w-100" value="保存">
        </form>

        <div class="col-1">
            <div class="position-fixed">
                @if($is_edit)
                    <a class="btn btn-primary btn-sm" href="{{ route('page.show', $page->name) }}">Show</a>
                @endif
                <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(window.top)">Top</div>
                <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(0, document.documentElement.scrollHeight)">End</div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/editor.md/editormd.js') }}"></script>
    <script>
        $(function () {
            let editor = editormd('editor-md', {
                height: '640px',
                path: '/assets/editor.md/lib/',
                markdown: $('#data_content_md').text(),
                saveHTMLToTextarea: true,
                name: 'content_md',
                htmlName: 'content_html',
                textarea: {
                    html: 'content-html',
                    markdown: 'content-md',
                },
                toc: false,
            });
        });
    </script>
@endsection

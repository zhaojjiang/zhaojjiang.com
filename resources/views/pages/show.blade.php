@extends('layouts.layout')

@section('title', $page->title)

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex container">
        <div id="content-box" class="col-11 h-100">
            <textarea id="data_content_md" class="d-none">{{ $page->content_md }}</textarea>
            <div id="content-container">
                <h1>{{ $page->title }}</h1>
                <div class="text-muted mb-3 border-bottom"
                     title="创建于 {{ $page->created_at->format('Y/m/d H:i') }} &#10;更新于 {{ $page->updated_at->format('Y/m/d H:i') }}">
                    {{ $page->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        <div class="col-lg-1 offset-lg-10 position-fixed h-100 d-none d-lg-block">
            @if(\Illuminate\Support\Facades\Auth::user())
                <a class="btn btn-primary btn-sm" href="{{ route('page.edit', $page->name) }}">Edit</a>
            @endif
            <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(window.top)">Top</div>
            <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(0, document.documentElement.scrollHeight)">End</div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/editor.md/editormd.min.js') }}"></script>
    <script src="{{ asset('assets/editor.md/lib/marked.min.js') }}"></script>
    <script src="{{ asset('assets/editor.md/lib/prettify.min.js') }}"></script>
    <script>
        $(function () {
            let view = editormd.markdownToHTML('content-container', {
                markdown: $('#data_content_md').text(),
                toc: false,
            });
        });
    </script>
@endsection

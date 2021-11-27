@extends('layouts.layout')

@section('title', $content->title)

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
        #toc-box {
            display: none;
        }
        @media (min-width: 992px) {
            #toc-box {
                display: unset;
            }
            .device-position-fixed {
                position: fixed !important;
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
            #page-header, #page-footer {
                width: 80%;
                margin-left: 20%;
            }
        }
    </style>
@endsection

@section('sidebar')
    <div id="toc-box" class="col-lg-3 h-100 overflow-auto device-position-fixed w-lg-20">
        <div id="toc-container">

        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex">
        <div id="content-box" class="col-lg-8 offset-lg-3 h-100 w-lg-75 offset-lg-w20">
            <textarea id="data_content_md" class="d-none">{{ $content->content_md }}</textarea>
            <div id="content-container">
                <h1>{{ $content->title }}</h1>

            </div>
        </div>

        <div class="col-lg-1 offset-lg-11 position-fixed h-100 w-lg-5 offset-lg-w95 d-none d-lg-block">
            @if(\Illuminate\Support\Facades\Auth::user())
                <a class="btn btn-primary btn-sm" href="{{ route('content.edit', $content) }}">Edit</a>
                <form action="{{ route('content.destroy', $content) }}" method="POST"
                      onsubmit="if(!confirm('删除？')) return false;">
                    {{ csrf_field() }}{{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-sm">DEL</button>
                </form>
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
            tocContainer: '#toc-container',
            tocTitle: '目录',
            tocDropdown: true,
            tocStartLevel: 2,
        });
    });
</script>
@endsection

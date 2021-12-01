@extends('layouts.layout')

@section('title', $content->title)

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
        #page-sidebar {
            max-height: 100vh;
        }
    </style>
@endsection

@section('sidebar-class', 'col-2 overflow-auto')
@section('sidebar')
    <div id="toc-box">
        <div id="toc-container">

        </div>
    </div>
@endsection

@section('content-class', 'col-10 overflow-auto')
@section('content')
    <div class="d-flex">
        <div id="content-box" class="col-11 overflow-hidden">
            <textarea id="data_content_md" class="d-none">{{ $content->content_md }}</textarea>
            <div id="content-container">
                <h1>{{ $content->title }}</h1>
                <div class="text-muted mb-3 border-bottom"
                      title="创建于 {{ $content->created_at->format('Y/m/d H:i') }} &#10;更新于 {{ $content->updated_at->format('Y/m/d H:i') }}">
                    {{ $content->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        <div class="col-1">
            <div class="position-fixed">
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
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/editor.md/editormd.js') }}"></script>
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

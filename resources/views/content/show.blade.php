@extends('layouts.layout')

@section('title', $content->title)

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <style>
        a {
            text-decoration: unset;
        }
        a:hover {
            color: unset;
        }
        .tag {
            background-color: #e8e8e8;
            color: #1775cc;
            font-weight: 400;
            font-size: 0.5em;
            padding: 4px 6px;
        }
        a.tag:hover {
            color: #1775cc;
        }
        #toc-box a {
            color: unset;
        }
        #toc-box ul, #toc-box li {
            list-style: none;
        }
        #toc-box ul.markdown-toc-list {
            padding-left: 5px;
        }
        #toc-box a::before {
            content: '- ';
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
            <h1 class="p-3">{{ $content->title }}</h1>
            <div class="mb-3 border-bottom p-3">
                <span class="text-muted"
                      title="创建于 {{ $content->created_at->format('Y/m/d H:i') }} &#10;更新于 {{ $content->updated_at->format('Y/m/d H:i') }}">
                    {{ $content->created_at->diffForHumans() }}
                </span>
                @foreach($content->tags as $tag)
                    <a class="tag" href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a>
                @endforeach
                @if($content->visibility === \App\Enums\Visibility::PRIVATE)
                    <i class="bi-lock"></i>
                @elseif($content->visibility === \App\Enums\Visibility::PROTECTED)
                    <i class="bi-key"></i>
                @endif
            </div>
            <div id="content-container">

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

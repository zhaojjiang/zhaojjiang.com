@extends('layouts.layout')

@section('title', !$is_edit ? 'New' : 'Edit')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editor.md/css/editormd.min.css') }}">
    <link href="https://cdn.bootcdn.net/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet">
    <style>
        a {
            text-decoration: unset;
        }
        #toc-box a {
            color: unset;
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
        <form action="{{ !$is_edit ? route('content.store') : route('content.update', $content) }}" method="POST"
              class="col-10">
            {{ $is_edit ? method_field('PUT') : '' }}
            {{ csrf_field() }}

            @include('shared._messages')

            <div class="row">
                <div class="input-group mb-3">
                    <input type="text" id="title" name="title" class="form-control"
                           aria-describedby="basic-addon" placeholder="标题"
                           autocomplete="off" value="{{ $is_edit ? $content->title : old('title') }}">
                </div>
            </div>

            <div class="row">
                <div class="input-group mb-3">
                    <select name="visibility" id="visibility" class="form-control" aria-describedby="basic-addon">
                        <option value="">选择可见性</option>
                        @foreach(\App\Enums\Visibility::getAllConstants() as $name => $value)
                            <option value="{{ $value }}" {{ $value === ($content->visibility ?? old('visibility')) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-group mb-3">
                    <select name="tags[]" id="tags" class="form-control" aria-describedby="basic-addon" multiple>
                        @foreach($tags as $id => $name)
                            <option value="{{ $id }}" {{ in_array($id, $tag_ids ?? (array)old('tags')) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <textarea id="data_content_md" style="display: none">{{ !$is_edit ? old('content_md') :  $content->content_md }}</textarea>
            <div id="editor-md" style="width: 100%; min-height: 500px;">

            </div>

            <input type="submit" class="btn btn-primary w-100" value="保存">
        </form>

        <div class="col-1">
            <div class="position-fixed">
                @if($is_edit)
                <a class="btn btn-primary btn-sm" href="{{ route('content.show', $content) }}">Show</a>
                @endif
                <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(window.top)">Top</div>
                <div class="btn btn-secondary btn-sm" onclick="window.scrollTo(0, document.documentElement.scrollHeight)">End</div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/editor.md/editormd.js') }}"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
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
            tocContainer: '#toc-container',
            tocStartLevel: 2,
            toolbarAutoFixed: false,
            placeholder: "输入内容",
            imageUpload: true,
            imageUploadURL: "{{ route('files.uploads') }}?from=editor.md&type=image",
        });

        $('#tags').select2({
            placeholder: '选择标签',
            allowClear: true,
        });
    });
</script>
@endsection

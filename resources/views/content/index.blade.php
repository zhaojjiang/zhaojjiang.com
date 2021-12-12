@extends('layouts.layout')

@if(\Illuminate\Support\Facades\Route::is('content.index'))
    @section('title', '内容')
@elseif(\Illuminate\Support\Facades\Route::is('tag.show'))
    @section('title', "标签:{$tag->name}")
@endif

@section('style')
    <style>
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
    </style>
@endsection

@section('content-class', 'col-12')
@section('content')
    <div class="container pt-3 pb-3">
        <ul class="list-group">
            @if(\Illuminate\Support\Facades\Auth::user())
                <li class="list-group-item">
                    <a href="{{ route('content.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
                </li>
            @endif
            @foreach($contents as $content)
                <li class="list-group-item">
                    <a href="{{ route('content.show', $content) }}">{{ $content->title }}</a>
                    @foreach($content->tags as $tag)
                        <a class="tag" href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a>
                    @endforeach
                    @if($content->visibility === \App\Enums\Visibility::PRIVATE)
                        <i class="bi-lock"></i>
                    @elseif($content->visibility === \App\Enums\Visibility::PROTECTED)
                        <i class="bi-key"></i>
                    @endif
                    <span class="float-end text-muted"
                          title="创建于 {{ $content->created_at->format('Y/m/d H:i') }} &#10;更新于 {{ $content->updated_at->format('Y/m/d H:i') }}">
                    {{ $content->created_at->diffForHumans() }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

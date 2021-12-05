@extends('layouts.layout')

@section('title', '标签')

@section('style')
    <style>
        a {
            text-decoration: unset;
            color: unset;
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
            margin: 4px;
        }
        a.tag:hover {
            color: #1775cc;
        }
    </style>
@endsection

@section('content-class', 'col-12')
@section('content')
    <div class="container pt-3">
        @foreach($tags as $tag)
            <a class="tag" href="{{ route('tag.show', $tag) }}" style="font-size: {{ 0.5 + 0.1 * $tag->contents_count }}em;">
                {{ $tag->name }}({{ $tag->contents_count }})
            </a>
        @endforeach
    </div>
@endsection

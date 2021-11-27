@extends('layouts.layout')

@section('style')
    <style>
        a {
            text-decoration: unset;
        }
    </style>
@endsection

@section('content')
    <div class="container pt-3">
        <ul class="list-group {{--list-group-numbered--}}">
            <li class="list-group-item">
                <a href="{{ route('content.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
            </li>
            @foreach($contents as $content)
                <li class="list-group-item">
                    <a href="{{ route('content.show', $content) }}">{{ $content->title }}</a>
                    <span class="float-end">{{ $content->created_at }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

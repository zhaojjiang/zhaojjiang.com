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
            @if(\Illuminate\Support\Facades\Auth::user())
                <li class="list-group-item">
                    <a href="{{ route('content.create') }}" class="btn btn-sm btn-outline-primary float-end">New</a>
                </li>
            @endif
            @foreach($contents as $content)
                <li class="list-group-item">
                    <a href="{{ route('content.show', $content) }}">{{ $content->title }}</a>
                    <span class="float-end">{{ $content->updated_at }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

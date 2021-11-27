@extends('layouts.layout')

@section('title', '登录')

@section('style')
    <style>
        html, body {
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex w-100 flex-column justify-content-center" style="padding-top: 10%">
        <form action="{{ route('login.submit') }}" method="POST" class="card col-lg-3 col-md-6 offset-lg-4 offset-md-3">
            @include('shared._messages')

            {{ csrf_field() }}
            <div class="card-header">登录</div>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="uname" class="col-form-label col-3">用户名</label>
                    <div class="col-9">
                        <input type="text" id="uname" name="uname" class="form-control"
                               value="{{ old('uname') ?: '' }}">
                    </div>
                </div>
                <div class="row">
                    <label for="password" class="col-form-label col-3">密&emsp;码</label>
                    <div class="col-9">
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm">登录</button>
        </form>
    </div>
@endsection

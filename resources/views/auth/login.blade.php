<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <title>登录</title>
    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>
<body>
<div class="d-flex w-100 h-100 flex-column justify-content-center">
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
</body>
</html>

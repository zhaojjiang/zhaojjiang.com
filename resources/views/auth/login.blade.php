<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.bootcdn.net/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <title>登录</title>
    <style>
        html {
            height: 100%;
        }
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #login-form {
            max-width: 50%;
            max-height: 50%;
            border: #008000 1px solid;
            border-radius: 5px;
            padding: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-input {
            margin: 3px 0 3px 0;
        }
        .form-error {
            color: red;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <form id="login-form" action="{{ route('login.submit') }}" method="POST">
        {{ csrf_field() }}
        <span>登录</span>
        <hr>
        <div class="form-input">
            <label for="uname">用户名</label>
            <input type="text" id="uname" name="uname" value="{{ old('uname') ?: '' }}">
        </div>
        <div class="form-input">
            <label for="password">密&emsp;码</label>
            <input type="password" id="password" name="password" value="">
        </div>
        <div class="form-input form-error {{ session('err_msg') ? '' : 'hidden' }}">{{ session('err_msg') }}</div>
        <button type="submit" style="background: green; color: white">登录</button>
    </form>
</body>
</html>

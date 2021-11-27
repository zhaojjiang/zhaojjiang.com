<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            width: 100%;
            height: 100%;
        }
        #page-content {
            min-height: calc(100% - 43px);
        }
        #page-footer {
            height: 40px;
            margin-top: 3px;
        }
    </style>
    @yield('style')
</head>
<body>

@yield('sidebar')
<div id="page-content">
    <div id="page-header">
        @include('layouts._header')
    </div>
    @yield('content')
</div>
<div id="page-footer">
    @include('layouts._footer')
</div>

@yield('script')
</body>
</html>

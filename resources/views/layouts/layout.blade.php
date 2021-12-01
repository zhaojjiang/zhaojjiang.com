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
        #page-header {
            position: fixed;
            width: 100%;
            z-index: 1;
        }
        #page-sidebar {
            position: sticky;
            top: 48px;
            height: calc(100vh - 48px);
        }
        #page-container {
            padding-top: 48px;
        }
        #page-footer {
            width: 100%;
            height: 40px;
        }
    </style>
    @yield('style')
</head>
<body>

<div class="d-flex flex-column">
    <div id="page-header">
        @include('layouts._header')
    </div>
    <div id="page-container" class="d-flex">
        <div id="page-sidebar" class="@yield('sidebar-class')">
            @yield('sidebar')
        </div>
        <div id="page-content" class="@yield('content-class')">
            @yield('content')
        </div>
    </div>
    <div id="page-footer">
        @include('layouts._footer')
    </div>
</div>

@yield('script')

@if(!empty($bd_tongji_id = \App\Models\Setting::get('bd_tongji_id')))
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?{{ $bd_tongji_id }}";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
@endif
</body>
</html>

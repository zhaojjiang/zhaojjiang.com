<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <style>
        a {
            text-decoration: unset;
        }
    </style>
</head>
<body>
@foreach($contents as $content)
    <div>
        <a href="{{ route('content.show', $content) }}">{{ $content->title }}</a> {{ $content->created_at }}
    </div>
@endforeach
</body>
</html>

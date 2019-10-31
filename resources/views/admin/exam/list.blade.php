<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<img src="{{ $url }}" alt="">
<br>
性别: @if($sex==1)
        男
    @else
        女
    @endif
<br>
昵称:{{ $name }}
</body>
</html>
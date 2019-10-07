<!DOCTYPE html>
<html>
<head>
  <title>{{ config('app.name') }}--@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 
  <script src="{{ asset('js/article.js') }}"></script>

  <style>
    html,body,h2{margin:0;}
    img{border:none}
    #pop{background:#fff;width:300px; height:282px;font-size:12px;position:fixed;right:0;bottom:0;}
    #popHead{line-height:32px;background:#f6f0f3;border-bottom:1px solid #e0e0e0;font-size:12px;padding:0 0 0 10px;}
    #popHead h2{font-size:14px;color:#666;line-height:32px;height:32px;}
    #popHead #popClose{position:absolute;right:10px;top:1px;}
    #popHead a#popClose:hover{color:#f00;cursor:pointer;}
  </style>

</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
  <ul class="navbar-nav ">


         @guest
        <li  class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
        @endguest
        @auth
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" >
                    注销
                </a>
            </div>
        </li>
        @endauth

  </ul>
</nav>

<!-- 大的banner -->
<div class="jumbotron" style="margin-top: 50px;">
  <div class="container">
    <h1>E-Commerce!</h1>
    <p>...</p>
    <p><a class="btn btn-primary btn-lg" href="#" role="button">No development</a></p>
  </div>
</div>


<div class="container">
  <div class="row">
  <!-- 左边菜单栏 -->
    <div class="col-md-3">
      @section('slide')
<div class="container">
  <div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    用户管理
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="/admin/save">用户添加</a>
      <a class="dropdown-item" href="/admin/index">用户展示</a>
    </div>
  </div>

<div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   品牌管理
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="/brand/save">品牌添加</a>
      <a class="dropdown-item" href="/brand/index">品牌展示</a>
    </div>
  </div>

      <div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   分类管理
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="/sort/save">分类添加</a>
      <a class="dropdown-item" href="/sort/index">分类展示</a>
    </div>
  </div>

    <div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   商品管理
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="/shop/save">商品添加</a>
      <a class="dropdown-item" href="/shop/index">商品展示</a>
    </div>
  </div>
</div>
      @show
    </div>
    <!-- 右边内容区域 -->

    <div class="col-md-9" >
      @yield('content')
    </div>
  </div>
</div>

@stack('scripts')



</body>
</html>
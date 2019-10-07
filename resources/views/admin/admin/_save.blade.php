@extends('layout.layout')

@section('title')
用户添加
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)  
            <li>
              {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
             
        </h3>
    </div>
    <div class="panel-body">
      <form action="" method="post">
      @csrf
        <div class="form-group">
          <label for="admin_account">用户名:</label>
          <input type="text" class="form-control" id="admin_account" placeholder="请输入用户名" name="admin_account" value="{{old('admin_account')  ?? $data->admin_account ?? ''  }}">
        </div>
        <div class="form-group">
          <label for="admin_pwd">密码:</label>
          <input type="password" class="form-control" id="admin_pwd" placeholder="请输入密码" name="admin_pwd" value="{{old('admin_pwd')  ?? $data->admin_pwd ?? ''  }}">
        </div>
        <div class="form-group">
          <label for="pwd">确认密码:</label>
          <input type="password" class="form-control" id="pwd" placeholder="请输入密码" name="pwd" value="{{old('pwd')  ?? $data->pwd ?? ''  }}">
        </div>
        <div class="form-group">
          <label for="admin_email">邮箱:</label>
          <input type="email" class="form-control" id="admin_email" placeholder="请输入邮箱" name="admin_email" value="{{old('admin_email')  ?? $data->admin_email ?? ''  }}">
        </div>
        <button type="submit" class="btn btn-primary">保存用户</button>
      </form>
    </div>
  </div>
</div>

@endsection

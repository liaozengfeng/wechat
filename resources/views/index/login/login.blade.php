<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>登陆</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="Write an awesome description for your new site here. You can edit this line in _config.yml. It will appear in your document head meta (for Google search results) and in your feed.xml site description.
">
<link rel="stylesheet" href="/css/weui.min.css">
<link rel="stylesheet" href="/css/jquery-weui.css">
<link rel="stylesheet" href="/css/style.css">
</head>
<body ontouchstart style="background:#323542;">
<!--主体-->
<div class="login-box">
  	<div class="lg-title">电子商务</div>
    <div class="login-form">
    	<form action="/index/login_do" method="post">
            @csrf
        	<div class="login-user-name common-div">
            	<span class="eamil-icon common-icon">
                	<img src="/images/eamil.png" />
                </span>
                <input type="tel" name="phone" value="" placeholder="请输入您的手机号" />        
            </div>
            <div class="login-user-pasw common-div">
            	<span class="pasw-icon common-icon">
                	<img src="/images/password.png" />
                </span>
                <input type="password" name="pwd" value="" placeholder="请输入您的密码" />        
            </div>
            <input type="submit" value="登陆" class="login-btn common-div">
            <a href="javascript:;" class="login-oth-btn common-div">微信登陆</a>
            <a href="javascript:;" class="login-oth-btn common-div">QQ登陆</a>
        </form>
    </div>
    <div class="forgets">
    	<a href="psd_chage.html">忘记密码？</a>
        <a href="regist">免费注册</a>
    </div>
</div>
<script src="/js/jquery-2.1.4.js"></script>
<script src="/js/fastclick.js"></script>
<script type="text/javascript" src="/js/jquery.Spinner.js"></script>
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script>

<script src="/js/jquery-weui.js"></script>

</body>
</html>

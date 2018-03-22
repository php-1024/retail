<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>登录页面 | 零壹新科技服务商管理平台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Agent')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/bootstrap-reset.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Agent/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Agent')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/style-responsive.css" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" id="currentForm" action="{{ url('agent/ajax/login_check') }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h2 class="form-signin-heading">零壹新科技服务商管理平台</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="用户名" autofocus name="username">
            <input type="password" class="form-control" placeholder="登录密码" name="password">
            <input type="text" name="captcha" class="form-control" placeholder="验证码" >
            <input type="hidden" id="captcha_url" value="{{ URL('agent/login/captcha') }}">
            <img src="{{ URL('agent/login/captcha') }}/{{ time() }}" id="login_captcha" onClick="return changeCaptcha();">

            <button class="btn btn-lg btn-login btn-block" type="button" onClick="postForm();">登录</button>
        </div>

    </form>

</div>

<script src="{{asset('public/Agent/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Agent')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Agent/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script>
    $(function(){
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    //更换验证码
    function changeCaptcha(){
        var url = $("#captcha_url").val();
        url = url + "/" + Math.random();
        $("#login_captcha").attr("src",url);
    }

    //提交表单
    function postForm(){
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url,data,function(json){
            if(json.status==1){
                window.location.reload();
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor:"#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
                changeCaptcha();
            }
        });
    }
</script>

</body>
</html>
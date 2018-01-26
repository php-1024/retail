<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>登陆页面 | 零壹新科技服务商管理平台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Proxy')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/bootstrap-reset.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Proxy')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/style-responsive.css" rel="stylesheet" />
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" id="currentForm" action="{{ url('proxy/ajax/login_check') }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h2 class="form-signin-heading">零壹新科技服务商管理平台</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="用户名" autofocus name="username">
            <input type="password" class="form-control" placeholder="登陆密码" name="password">
            <button class="btn btn-lg btn-login btn-block" type="submit" onClick="postForm();">登陆</button>
        </div>

    </form>

</div>

<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script>
    $(function(){
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
//    //更换验证码
//    function changeCaptcha(){
//        var url = $("#captcha_url").val();
//        url = url + "/" + Math.random();
//        $("#login_captcha").attr("src",url);
//    }

    //提交表单
    function postForm(){
        alert(1);
//        var target = $("#currentForm");
//        var url = target.attr("action");
//        console.log(url);
//        var data = target.serialize();
//        console.log(data);
//        $.post(url,data,function(json){
//            if(json.status==1){
//                window.location.reload();
//            }else{
//                swal({
//                    title: "提示信息",
//                    text: json.data,
//                    confirmButtonColor:"#DD6B55",
//                    confirmButtonText: "确定",
//                    //type: "warning"
//                });
//                changeCaptcha();
//            }
//        });
    }
</script>

</body>
</html>
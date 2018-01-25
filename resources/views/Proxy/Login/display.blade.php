{{--<!DOCTYPE html>--}}
{{--<html>--}}


{{--<body class="green-bg">--}}

{{--<div class="middle-box text-center loginscreen animated fadeInDown">--}}
    {{--<div>--}}
        {{--<div>--}}

            {{--<h1 class="logo-name">ZERONE</h1>--}}

        {{--</div>--}}
        {{--<h3>欢迎使用零壹平台管理系统</h3>--}}
        {{--<form class="m-t" role="form" id="currentForm" action="{{ url('zerone/ajax/login_check') }}">--}}
            {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" name="username" id="currentForm" class="form-control" placeholder="用户名|手机号" >--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<input type="password" name="password" class="form-control" placeholder="登录密码" >--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-6" style="padding-left:0px;">--}}

                {{--<input type="text" name="captcha" class="form-control" placeholder="验证码" >--}}

            {{--</div>--}}
            {{--<div class="form-group col-md-6" >--}}
                {{--<input type="hidden" id="captcha_url" value="{{ URL('zerone/login/captcha') }}">--}}
                {{--<img src="{{ URL('zerone/login/captcha') }}/{{ time() }}" id="login_captcha" onClick="return changeCaptcha();">--}}

            {{--</div>--}}
            {{--<button type="button" class="btn btn-primary block full-width m-b" onClick="postForm();">登录</button>--}}
        {{--</form>--}}

        {{--<p class="m-t"> <small>零壹新科技（深圳）有限公司 &copy; 2017-2027</small> </p>--}}
    {{--</div>--}}
{{--</div>--}}

{{--</body>--}}
{{--</html>--}}

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
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Proxy')}}/css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Proxy')}}/js/html5shiv.js"></script>
    <script src="{{asset('public/Proxy')}}/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" action="select_proxy.html">
        <h2 class="form-signin-heading">零壹新科技服务商管理平台</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="用户名" autofocus>
            <input type="password" class="form-control" placeholder="登陆密码">
            <button class="btn btn-lg btn-login btn-block" type="submit">登陆</button>
        </div>

    </form>

</div>

<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
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
        console.log(url);
        var data = target.serialize();
        console.log(data);
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
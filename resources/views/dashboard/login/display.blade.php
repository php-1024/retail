<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技后台管理系统| 登陆界面</title>

    <link href="{{asset('public/dashboard/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/dashboard/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/dashboard')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/dashboard')}}/css/style.css" rel="stylesheet">

</head>

<body class="green-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">ZERONE</h1>

            </div>
            <h3>欢饮使用零壹新科技后台管理系统</h3>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登陆</button>
            </form>
            <p class="m-t"> <small>零壹新科技（深圳）有限公司 &copy; 2017-10-20</small> </p>
        </div>
    </div>
    <script src="{{asset('public/dashboard/library/jquery')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/dashboard/library/bootstrap')}}/js/bootstrap.min.js"></script>
</body>
</html>

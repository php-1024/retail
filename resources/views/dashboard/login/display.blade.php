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

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">01</h1>

            </div>
            <h3>Welcome to IN+</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="login.html#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{asset('public/dashboard/library/jquery')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/dashboard/library/bootstrap')}}/js/bootstrap.min.js"></script>

</body>

</html>

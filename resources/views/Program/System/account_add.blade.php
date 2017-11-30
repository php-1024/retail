<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Program/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Program/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/Program')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Program')}}/css/style.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Program/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Program/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>添加账号</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">系统管理</a>
                    </li>
                    <li >
                        <strong>添加账号</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>添加账号</h5>
                        </div>
                        <form class="m-t" role="form" id="currentForm" action="{{ url('program/ajax/checklogin') }}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="ibox-content">
                                <form method="get" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">登陆账号</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="登陆账号"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">登陆密码</label>
                                        <div class="col-sm-10"><input type="password" class="form-control" placeholder="登陆密码"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">重复登陆密码</label>
                                        <div class="col-sm-10"><input type="password" class="form-control" placeholder="重复登陆密码"></div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group ">
                                        <div class="col-sm-4 col-sm-offset-5">
                                            <button class="btn btn-primary" id="addbtn" type="button">确认添加</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('Program/Public/Footer')
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/Program/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Program/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Program/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Program/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Program')}}/js/inspinia.js"></script>
<script src="{{asset('public/Program/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Program/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script>

</script>
</body>

</html>

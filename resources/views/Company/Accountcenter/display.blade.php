<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 商户管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Company/library/jPlayer')}}/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/app.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Company/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/respond.min.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        <div class="navbar-header aside bg-success dk">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="icon-list"></i>
            </a>
            <a href="index.html" class="navbar-brand text-lt">
                <i class="fa fa-cloud"></i>

                <span class="hidden-nav-xs m-l-sm">ZERONE</span>
            </a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
                <i class="icon-settings"></i>
            </a>
        </div>
        <ul class="nav navbar-nav hidden-xs">
            <li>
                <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
                    <i class="fa fa-indent text"></i>
                    <i class="fa fa-dedent text-active"></i>
                </a>
            </li>
        </ul>

        <div class="navbar-right ">
            <ul class="nav navbar-nav m-n hidden-xs nav-user user">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
                        <i class="icon icon-user"></i>
                        admin-超级管理员<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        <li>
                            <span class="arrow top"></span>
                            <a href="#"></a>
                        </li>
                        <li>
                            <a href="profile.html">个人信息</a>
                        </li>

                        <li>
                            <a href="password.html">修改密码</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="login.html" data-toggle="ajaxModal" >退出登录</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('Company/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">公司资料</h3>
                        </div>
                        <section class="panel panel-default">

                            <header class="panel-heading font-bold">
                                公司资料修改
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="get">
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">服务商</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" disabled="" value="零壹新科技（深圳）有限公司">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">登陆账号</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" disabled="" value="200307">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">商户名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="韦小堡（深圳）有限公司">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">负责人手机号码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="13123456789">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">负责人姓名</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" disabled="" value="韦江">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">负责人身份证号</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" disabled="" value="111122223333444455">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-6">

                                            <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </form>
                            </div>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
@include('Zerone/Public/Footer')
<script src="{{asset('public/Company')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Company/')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Company')}}/js/app.js"></script>
<script src="{{asset('public/Company/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Company')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Company/library/jPlayer')}}/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Company/library/jPlayer')}}/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
</script>>
</body>
</html>
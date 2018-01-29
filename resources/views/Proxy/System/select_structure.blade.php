<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>零壹新科技服务商管理平台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Proxy')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/Proxy')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Proxy')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{asset('public/Proxy')}}/css/owl.carousel.css" type="text/css">
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('public/Proxy')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Proxy')}}/js/html5shiv.js"></script>
    <script src="{{asset('public/Proxy')}}/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        @include('Proxy/Public/Header')
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        @include('Proxy/Public/Nav')
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">ZER<span>O</span>NE</a>

            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#">
                            <i class="icon-user"></i>
                            <span class="username">admin-超级管理员</span>
                        </a>

                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <span class="username">退出登陆</span>
                            <i class="icon-arrow-right"></i>
                        </a>

                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu">
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="icon-desktop"></i>
                            <span>系统管理</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a href="index.html">系统首页</a></li>
                            <li><a href="config.html">参数设置</a></li>
                            <li><a href="proxy_info.html">公司信息设置</a></li>
                            <li><a href="structure.html">公司人员结构</a></li>
                            <li><a href="operationlog.html">操作日志查询</a></li>
                            <li><a href="loginlog.html">登陆日志查询</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="icon-user"></i>
                            <span>个人信息</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a href="account_info.html">个人信息</a></li>
                            <li><a href="password.html">登陆密码修改</a></li>
                            <li><a href="safe_password.html">安全密码修改</a></li>
                            <li><a href="myoperationlog.html">我的操作日志</a></li>
                            <li><a href="myloginlog.html">我的登陆日志</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="icon-group"></i>
                            <span>下级人员管理</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a href="role_add.html">权限角色添加</a></li>
                            <li><a href="role_list.html">权限角色列表</a></li>
                            <li><a href="subordinate_add.html">下级人员添加</a></li>
                            <li><a href="subordinate_list.html">下级人员列表</a></li>
                            <li><a href="subordinate_structure.html">下级人员结构</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="icon-code"></i>
                            <span>系统资产管理</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a href="program_list.html">系统资产列表</a></li>
                            <li><a href="program_log.html">资产划拨记录</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="icon-sitemap"></i>
                            <span>下辖商户管理</span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub">
                            <li><a href="register_setting.html">商户注册列表</a></li>
                            <li><a href="company_list.html">商户列表</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu active">
                        <a href="javascript:;">
                            <i class="icon-cloud"></i>
                            <span>商户店铺管理</span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub">
                            <li class="active"><a href="store_list.html">店铺列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="icon-user"></i>
                            <span>退出登陆</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-cloud"></i> 商户店铺管理</a></li>
                            <li class="active">店铺列表</li>
                        </ul>
                        <!--breadcrumbs end -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <button type="button" class="btn btn-info" onclick="location.href='store_list.html'"><i class="icon-reply"></i> 返回列表</button>
                                <button type="button" class="btn btn-primary" id="expand-all"><i class="icon-plus"></i> 展开所有</button>
                                <button type="button" class="btn btn-primary" id="collapse-all"><i class="icon-minus"></i> 合并所有</button>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                店铺人员结构
                            </header>
                            <div class="panel-body">
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                <span class="label label-primary"><i class="icon-sitemap"></i></span> 刘记鸡煲王（总店）
                                            </div>
                                            <ol class="dd-list">
                                                <li class="dd-item" data-id="2">
                                                    <div class="dd-handle">
                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00</span>
                                                        <span class="label label-info"><i class="icon-user"></i></span> 张三-店铺负责人[b13123456789_1，店长，13123456789 ]
                                                    </div>
                                                    <ol class="dd-list">
                                                        <li class="dd-item" data-id="3">
                                                            <div class="dd-handle">
                                                                <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                <span class="label label-info"><i class="icon-user"></i></span> 王五-店长[b13123456789_1，店长，13123456789 ]
                                                            </div>
                                                            <ol class="dd-list">
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                            </ol>
                                                        </li>

                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                <span class="label label-primary"><i class="icon-sitemap"></i></span> 刘记鸡煲王（宝能店）
                                            </div>
                                            <ol class="dd-list">
                                                <li class="dd-item" data-id="2">
                                                    <div class="dd-handle">
                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00</span>
                                                        <span class="label label-info"><i class="icon-user"></i></span> 张三-店铺负责人[b13123456789_1，店长，13123456789 ]
                                                    </div>
                                                    <ol class="dd-list">
                                                        <li class="dd-item" data-id="3">
                                                            <div class="dd-handle">
                                                                <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                <span class="label label-info"><i class="icon-user"></i></span> 王五-店长[b13123456789_1，店长，13123456789 ]
                                                            </div>
                                                            <ol class="dd-list">
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                            </ol>
                                                        </li>

                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>

                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                <span class="label label-primary"><i class="icon-sitemap"></i></span> 刘记鸡煲王（龙岗店）
                                            </div>
                                            <ol class="dd-list">
                                                <li class="dd-item" data-id="2">
                                                    <div class="dd-handle">
                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00</span>
                                                        <span class="label label-info"><i class="icon-user"></i></span> 张三-店铺负责人[b13123456789_1，店长，13123456789 ]
                                                    </div>
                                                    <ol class="dd-list">
                                                        <li class="dd-item" data-id="3">
                                                            <div class="dd-handle">
                                                                <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                <span class="label label-info"><i class="icon-user"></i></span> 王五-店长[b13123456789_1，店长，13123456789 ]
                                                            </div>
                                                            <ol class="dd-list">
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                                <li class="dd-item" data-id="4">
                                                                    <div class="dd-handle">
                                                                        <span class="pull-right"> 添加时间 2017-12-08 12:00:00 </span>
                                                                        <span class="label label-info"><i class="icon-user"></i></span> 王五-店员[b13123456789_1，店长，13123456789 ]
                                                                    </div>
                                                                </li>
                                                            </ol>
                                                        </li>

                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>

                                    </ol>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </section>

            </section>
        </section>
        <!--main content end-->
    </section>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('public/Proxy')}}/js/jquery.js"></script>
    <script src="{{asset('public/Proxy')}}/js/jquery-1.8.3.min.js"></script>
    <script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/Proxy')}}/js/jquery.scrollTo.min.js"></script>
    <script src="{{asset('public/Proxy')}}/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--common script for all pages-->
    <script src="{{asset('public/Proxy')}}/js/common-scripts.js"></script>
    <script src="{{asset('public/Proxy')}}/nestable/jquery.nestable.js"></script>

    <script>

        //owl carousel

        $(document).ready(function() {
            $('#nestable2').nestable();


            $('#expand-all').click(function(){
                $('.dd').nestable('expandAll');
            });

            $('#collapse-all').click(function(){
                $('.dd').nestable('collapseAll');
            });


        });



    </script>

</body>
</html>

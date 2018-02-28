<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 分店业务系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch')}}/library/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/excanvas.js"></script>
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
                            <a href="profile.html">账号信息</a>
                        </li>

                        <li>
                            <a href="password.html">修改密码</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="login.html" >退出登录</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">



                            <!-- nav -->
                            <nav class="nav-primary  hidden-xs">
                                <ul class="nav" data-ride="collapse">
                                    <li class="active">
                                        <a href="index.html" class="auto">
                                            <i class="fa fa-bar-chart-o  text-success"></i>
                                            <span class="font-bold ">分店概况</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="jacascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="icon-screen-desktop icon text-success">
                                            </i>
                                            <span class="font-bold">账户中心</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li>
                                                <a href="profile.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>账号信息</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="password.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>登录密码修改</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="safe_password.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>安全密码设置</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="message_setting.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>消息接收设置</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="operation_log.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>操作日志</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="login_log.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>登录日志</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="cashier.html" class="auto">
                                            <i class="icon icon-calculator  text-success"></i>
                                            <span class="font-bold ">收银台</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="icon icon-basket-loaded text-success">
                                            </i>
                                            <span class="font-bold">商品管理</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li >
                                                <a href="category_add.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>添加商品分类</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="category_list.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>商品分类列表</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="goods_add.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>添加商品</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="goods_list.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>商品列表</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="icon icon-list text-success">
                                            </i>
                                            <span class="font-bold">订单管理</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li >
                                                <a href="order_spot.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>现场订单</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="order_takeout.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>外卖订单</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="order_appointment.html" class="auto">
                                            <i class="icon icon-clock  text-success"></i>
                                            <span class="font-bold ">预约管理</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="icon icon-printer text-success">
                                            </i>
                                            <span class="font-bold">设施管理</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li >
                                                <a href="room_add.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>添加包厢</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="room_list.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>包厢管理</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="table_add.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>添加餐桌</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="table_list.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>餐桌管理</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="printer_add.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>添加打印机</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="printer_list.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>打印机管理</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="fa fa-group text-success">
                                            </i>
                                            <span class="font-bold">下属管理</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li >
                                                <a href="role_add.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>角色添加</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="role_list.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>角色列表</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="subordinate_add.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>下属添加</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="subordinate_list.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>下属列表</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="fa fa-user text-success">
                                            </i>
                                            <span class="font-bold">用户管理</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li >
                                                <a href="user_tag.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>粉丝标签管理</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="user_list.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>粉丝用户管理</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="user_timeline.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>粉丝用户足迹</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="fa fa-money text-success">
                                            </i>
                                            <span class="font-bold">财务管理</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li >
                                                <a href="balance.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>余额管理</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="credit.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>积分管理</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                                            <i class="fa fa-cog text-success">
                                            </i>
                                            <span class="font-bold">支付设置</span>
                                        </a>
                                        <ul class="nav dk text-sm">
                                            <li class="active">
                                                <a href="wechat_setting.html" class="auto">
                                                    <i class="fa  fa-angle-right text-xs text-info"></i>
                                                    <span>微信支付</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="zerone_setting.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>零舍壹得</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="zf_sheng_setting.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>盛付通</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="zf_kuaifu_setting.html" class="auto">
                                                    <i class="fa fa-angle-right text-xs text-info"></i>
                                                    <span>快付通</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="login.html" class="auto">
                                            <i class="icon-logout icon text-danger"></i>
                                            <span>退出系统</span>
                                        </a>
                                    </li>
                                </ul>

                            </nav>
                            <!-- / nav -->
                        </div>
                    </section>


                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">分店概况</h3>
                        </div>

                        <div class="col-lg-3">
                            <section class="panel panel-default">

                                <header class="panel-heading font-bold">
                                    概况

                                    <button id="editBtn" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit "></i>&nbsp;编辑</button>
                                </header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="get">
                                        <div class="form-group clearfix text-center m-t">
                                            <div class="inline">
                                                <div class="thumb-lg" >
                                                    <img src="images/m0.jpg" class="img-circle" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">模式</label>
                                            <div class="col-sm-8">
                                                <div>
                                                    <label class="label label-success m-t-xs">
                                                        餐饮系统【先吃后付】
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">分店名称</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">刘记鸡煲王【龙岗店】</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">类型</label>
                                            <div class="col-sm-8">
                                                <label class="label label-success">主店</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">负责人</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">张老三</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">手机号码</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">13123456789</label>
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">状态</label>
                                            <div class="col-sm-8">
                                                <label class="label label-success">正常运营</label>
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">店铺地址</label>
                                            <div class="col-sm-8">
                                                <label class="label label-primary">广东省深圳市龙岗区万汇大厦1606</label>
                                            </div>
                                        </div>


                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-9 ">
                            <div class="col-lg-12">
                                <div class="col-lg-4 state-overview"">
                                <section class="panel">
                                    <div class="symbol bg-danger">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="value">
                                        <h1>168888.03</h1>
                                        <p>元营收</p>
                                    </div>
                                </section>
                            </div>

                            <div class="col-lg-4 state-overview"">
                            <section class="panel">
                                <div class="symbol bg-success">
                                    <i class="icon icon-user"></i>
                                </div>
                                <div class="value">
                                    <h1>1680</h1>
                                    <p>个粉丝用户</p>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-4 state-overview"">
                        <section class="panel">
                            <div class="symbol bg-info">
                                <i class="icon icon-basket-loaded"></i>
                            </div>
                            <div class="value">
                                <h1>100</h1>
                                <p>个商品</p>
                            </div>
                        </section>
                        </div>


                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-4 state-overview"">
                            <section class="panel">
                                <div class="symbol bg-warning">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="value">
                                    <h1>666</h1>
                                    <p>现场订单数</p>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-4 state-overview"">
                        <section class="panel">
                            <div class="symbol bg-primary">
                                <i class="icon icon-list"></i>
                            </div>
                            <div class="value">
                                <h1>888</h1>
                                <p>外卖订单</p>
                            </div>
                        </section>
                        </div>

                        <div class="col-lg-4 state-overview"">
                        <section class="panel">
                            <div class="symbol bg-dark">
                                <i class="icon icon-printer"></i>
                            </div>
                            <div class="value">
                                <h1>5</h1>
                                <p>台打印机</p>
                            </div>
                        </section>
                        </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading">最近登陆日志</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>登陆账号</th>
                                            <th>登陆IP</th>
                                            <th>登陆地址</th>
                                            <th>登陆时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>

                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>

                            <div class="col-lg-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading">最近操作日志</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>操作账号</th>
                                            <th>操作内容</th>
                                            <th>操作时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登陆密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">店铺信息编辑</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">分店名称</label>
                            <div class="col-sm-10">
                                <input type="text" value="刘记鸡煲王【龙岗店】" placeholder="店铺名称" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">负责人</label>
                            <div class="col-sm-10">
                                <input type="text" value="张老三" placeholder="负责人" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">手机号码</label>
                            <div class="col-sm-10">
                                <input type="text" value="13123456789" placeholder="手机号码" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">店铺LOGO</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                            </div>
                        </div>

                        <div style="clear:both;"></div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 text-right">店铺地址</label>
                            <div class="col-sm-10">
                                <input type="text" value="广东省深圳市龙岗区万汇大厦1606" placeholder="店铺地址" class="form-control">
                            </div>
                        </div>

                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                            </div>
                        </div>
                        <div style="clear:both;"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="save_btn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/library/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch')}}/library/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#save_btn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
</script>
</body>
</html>
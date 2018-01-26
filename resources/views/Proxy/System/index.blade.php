<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>零壹新科技服务商管理平台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Proxy')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/Proxy')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Proxy')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{asset('public/Proxy')}}/css/owl.carousel.css" type="text/css">
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
    <header class="header white-bg">
        @include('Zerone/Public/Header')
    </header>
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="active sub-menu">
                    <a href="javascript:;">
                        <i class="icon-desktop"></i>
                        <span>系统管理</span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub">
                        <li class="active"><a href="index.html">系统首页</a></li>
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
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="register_setting.html">商户注册列表</a></li>
                        <li><a href="company_list.html">商户列表</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="icon-cloud"></i>
                        <span>商户店铺管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="store_list.html">店铺列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="login.html">
                        <i class="icon-power-off"></i>
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
                        <li><a href="#"><i class="icon-desktop"></i> 系统管理</a></li>
                        <li class="active">系统首页</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>

            <div class="row state-overview">
                <div class="col-lg-6 col-sm-6">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="icon-user"></i>
                        </div>
                        <div class="value">
                            <h1>22</h1>
                            <p>公司人员</p>
                        </div>
                    </section>
                </div>

                <div class="col-lg-6 col-sm-6">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="icon-sitemap"></i>
                        </div>
                        <div class="value">
                            <h1>300</h1>
                            <p>商户</p>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                            最新登陆记录
                        </header>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>用户</th>
                                <th>登陆IP</th>
                                <th>登陆地址</th>
                                <th>登陆时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>14.127.254.249</td>
                                <td>中国广东深圳</td>
                                <td>2018-01-16 09:37:37</td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                </div>

                <div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                            最新操作记录
                        </header>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>用户</th>
                                <th>操作</th>
                                <th>时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            <tr>
                                <td>admin</td>
                                <td>编辑了菜单系统管理</td>
                                <td>2018-01-15 22:14:16</td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
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


<script>

    //owl carousel

    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
</html>

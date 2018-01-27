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

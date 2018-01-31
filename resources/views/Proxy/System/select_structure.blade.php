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
    <link href="{{asset('public/Proxy')}}/css/nestable.css" rel="stylesheet" />

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
                            公司人员结构
                        </header>
                        <div class="panel-body">
                            <div class="dd" id="nestable2">

                                <ol class="dd-list">
                                    <li class="dd-item" data-id="2">
                                        <div class="dd-handle">
                                            <span class="label label-primary"><i class="icon-user"></i></span> {{$oneAcc->account_info->realname}}-公司负责人
                                        </div>
                                        {!! $structure  !!}
                                    </li>

                                </ol>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <!--main content end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Proxy/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('public/Proxy')}}/js/common-scripts.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.nestable.js"></script>

</body>
</html>

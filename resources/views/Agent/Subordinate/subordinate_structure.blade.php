<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>零壹新科技服务商管理平台</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Agent')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/Agent')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Agent')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" />
    <link href="{{asset('public/Agent')}}/css/owl.carousel.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Agent')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/style-responsive.css" rel="stylesheet" />
    <link href="{{asset('public/Agent')}}/css/nestable.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Agent')}}/js/html5shiv.js"></script>
    <script src="{{asset('public/Agent')}}/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        @include('Agent/Public/Header')
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        @include('Agent/Public/Nav')
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
                        <li class="active">公司人员结构</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
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

                                            <span class="label label-primary"><i class="icon-user"></i></span> {{ $admin_data['account'] }}-公司负责人
                                        </div>
                                        <ol class="dd-list">
                                            {{--<li class="dd-item" data-id="3">--}}
                                                {{--<div class="dd-handle">--}}
                                                    {{--<span class="pull-right"> 添加时间：2018-01-17 02:22:23</span>--}}
                                                    {{--<span class="label label-primary"><i class="icon-user"></i></span> 张三-运营总监--}}
                                                {{--</div>--}}
                                                {{--<ol class="dd-list">--}}
                                                    {{--<li class="dd-item" data-id="4">--}}
                                                        {{--<div class="dd-handle">--}}
                                                            {{--<span class="pull-right"> 添加时间：2018-01-17 02:22:23</span>--}}
                                                            {{--<span class="label label-primary"><i class="icon-user"></i></span> 王张三-客户经理--}}
                                                        {{--</div>--}}
                                                    {{--</li>--}}
                                                    {!! $structure  !!}

                                                {{--</ol>--}}
                                            {{--</li>--}}
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
    <!--main content end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Agent')}}/js/jquery.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Agent')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('public/Agent')}}/js/common-scripts.js"></script>
<script src="{{asset('public/Agent/library/nestable')}}/js/jquery.nestable.js"></script>
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


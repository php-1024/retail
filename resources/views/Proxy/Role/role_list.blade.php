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
                        <li><a href="#"><i class="icon-group"></i> 下级人员管理</a></li>
                        <li class="active">权限角色列表</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" method="get">

                                <div class="form-group">
                                    <label class="control-label col-lg-1" for="inputSuccess">角色名称</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" placeholder="角色名称">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-primary"><i class="icon-search"></i> 查询</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        权限角色列表
                                    </header>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>角色名称</th>
                                            <th>角色权限</th>
                                            <th>添加时间</th>
                                            <th class="text-right">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>订单管理员</td>

                                            <td>
                                                <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                                <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                                <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                                <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;

                                            </td>
                                            <td>2017-08-08 10:30:30</td>
                                            <td class="text-right">
                                                <button type="button" id="editBtn"  class="btn  btn-xs btn-primary"><i class="icon-edit"></i>&nbsp;&nbsp;编辑</button>
                                                <button type="button" id="deleteBtn" class="btn  btn-xs btn-danger"><i class="icon-remove"></i>&nbsp;&nbsp;删除</button>
                                            </td>
                                        </tr>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="99">
                                                <ul class="pagination pull-right">
                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="first" href="#first">«</a>
                                                    </li>

                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="prev" href="#prev">‹</a>
                                                    </li>
                                                    <li class="footable-page active">
                                                        <a data-page="0" href="#">1</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">2</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">3</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">4</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">5</a>
                                                    </li>
                                                    <li class="footable-page-arrow">
                                                        <a data-page="next" href="#next">›</a>
                                                    </li>
                                                    <li class="footable-page-arrow">
                                                        <a data-page="last" href="#last">»</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </section>
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
<script src="{{asset('public/Proxy')}}/js/jquery.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('public/Proxy')}}/js/common-scripts.js"></script>
</body>
</html>


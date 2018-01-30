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
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-code"></i> 系统资产管理</a></li>
                        <li class="active">系统资产列表</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        系统资产列表
                                    </header>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>套餐名称</th>
                                            <th>包含程序</th>
                                            <th>添加时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>零壹科技餐饮系统</td>

                                            <td>
                                                <div>
                                                    <span class="label label-danger"><i class="icon-code"></i> 零壹新科技餐饮总店系统</span> &nbsp;&nbsp;
                                                    <span class="label label-primary">剩余:30 套</span>&nbsp;&nbsp;
                                                    <span class="label label-warning">已用:10 套</span>&nbsp;&nbsp;
                                                </div>
                                                <div style=" margin-top: 30px;"></div>
                                                <div>
                                                    <span class="label label-danger"><i class="icon-code"></i> 零壹新科技餐饮店铺系统</span>  &nbsp;&nbsp;
                                                    <span class="label label-primary">剩余:150 套</span>&nbsp;&nbsp;
                                                    <span class="label label-warning">已用:15 套</span>&nbsp;&nbsp;
                                                </div>
                                            </td>
                                            <td>2017-08-08 10:30:30</td>

                                        </tr>


                                        <tr>
                                            <td>2</td>
                                            <td>零壹科技商超系统</td>

                                            <td>
                                                <div>
                                                    <span class="label label-danger"><i class="icon-code"></i> 零壹新科技商超总店系统</span> &nbsp;&nbsp;
                                                    <span class="label label-primary">剩余:30 套</span>&nbsp;&nbsp;
                                                    <span class="label label-warning">已用:10 套</span>&nbsp;&nbsp;
                                                </div>
                                                <div style=" margin-top: 30px;"></div>
                                                <div>
                                                    <span class="label label-danger"><i class="icon-code"></i> 零壹新科技餐饮店铺系统</span>  &nbsp;&nbsp;
                                                    <span class="label label-primary">剩余:150 套</span>&nbsp;&nbsp;
                                                    <span class="label label-warning">已用:15 套</span>&nbsp;&nbsp;
                                                </div>
                                            </td>
                                            <td>2017-08-08 10:30:30</td>

                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>零壹科技酒店系统</td>

                                            <td>
                                                <div>
                                                    <span class="label label-danger"><i class="icon-code"></i> 零壹新科技商超总店系统</span> &nbsp;&nbsp;
                                                    <span class="label label-primary">剩余:30 套</span>&nbsp;&nbsp;
                                                    <span class="label label-warning">已用:10 套</span>&nbsp;&nbsp;
                                                </div>

                                            </td>
                                            <td>2017-08-08 10:30:30</td>
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
</body>
</html>


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
                        <li><a href="#"><i class="icon-group"></i> 下级人员管理</a></li>
                        <li class="active">权限角色添加</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            权限角色添加
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" method="get">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">角色名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="admin" placeholder="角色名称" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">用户权限</label>
                                    <div class="col-sm-10">
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                            </label>
                                        </div>
                                        <div style="margin-top: 20px;"></div>

                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                            </label>
                                        </div>
                                        <div style="margin-top: 20px;"></div>

                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                            </label>
                                        </div>
                                        <div style="margin-top: 20px;"></div>

                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                            </label>
                                        </div>
                                        <div style="margin-top: 20px;"></div>

                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                            </label>
                                            &nbsp;&nbsp;
                                            <label class="i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                            </label>
                                        </div>
                                        <div style="margin-top: 20px;"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">安全密码</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="" placeholder="安全密码" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group" style="text-align: center;">
                                    <button type="button" id="addbtn" class="btn btn-shadow btn-info">提交</button>
                                </div>
                            </form>
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

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
    <link href="{{asset('public/Proxy/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

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
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-user"></i> 个人信息</a></li>
                            <li class="active">个人信息</li>
                        </ul>
                        <!--breadcrumbs end -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <section class="panel">
                            <header class="panel-heading">
                                个人信息修改
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal tasi-form" method="get">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">用户账号</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="admin" disabled="true" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">用户角色</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="超级管理员" disabled="true" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">用户角色</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="超级管理员" disabled="true" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">真实姓名</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="薛志豪">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">联系方式</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="13123456789">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">安全密码 </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group" style="text-align: center;">
                                        <button type="button" id="addbtn" class="btn btn-shadow btn-info">保存信息</button>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-7">
                        <section class="panel">
                            <header class="panel-heading">
                                我的权限
                            </header>
                            <div class="panel-body">
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" disabled=""> 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单删除
                                    </label>
                                </div>
                                <div style="margin-top: 10px;"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" disabled=""> 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单删除
                                    </label>
                                </div>
                                <div style="margin-top: 10px;"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" disabled=""> 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单删除
                                    </label>
                                </div>
                                <div style="margin-top: 10px;"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" disabled=""> 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单删除
                                    </label>
                                </div>
                                <div style="margin-top: 10px;"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" disabled=""> 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" disabled=""> 订单删除
                                    </label>
                                </div>
                                <div style="margin-top: 10px;"></div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </aside>
</section>
        <!--main content end-->
<!-- Custom and plugin javascript -->
<script src="{{asset('public/Proxy/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Proxy/library/sweetalert')}}/js/sweetalert.min.js"></script>


<script>
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
            }
        });
    }
    //提交表单
    function postSetForm() {
        var target = $("#SetForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor:"#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
            }
        });
    }
</script>

</body>
</html>

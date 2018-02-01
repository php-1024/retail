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
    <link href="{{asset('public/Proxy')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="{{asset('public/Proxy')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet"/>
    <link href="{{asset('public/Proxy')}}/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Proxy')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/style-responsive.css" rel="stylesheet"/>
    <link href="{{asset('public/Proxy/library/wizard')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Proxy/library/iCheck')}}/css/custom.css" rel="stylesheet">
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
                        <li><a href="#"><i class="icon-group"></i> 下级管理</a></li>
                        <li class="active">添加下级人员</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            添加下级人员
                        </header>
                        <div class="panel-body">
                            <form method="get" class="form-horizontal">
                                <div id="rootwizard">
                                    <ul>
                                        <li><a href="#tab1" data-toggle="tab"><span style="color:#999;"
                                                                                    class="label">1</span> 填写基础资料</a>
                                        </li>
                                        <li><a href="#tab2" data-toggle="tab"><span style="color:#999;"
                                                                                    class="label">2</span> 指派权限</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1">

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">手机号码</label>
                                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">用户密码</label>
                                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">重复密码</label>
                                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">真实姓名</label>
                                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab2">

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">权限角色</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control m-b" name="account">
                                                        <option>订单管理员</option>
                                                        <option>装修员</option>
                                                        <option>客服人员</option>
                                                        <option>店铺管理员</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" class="btn btn-primary"><i
                                                                class="icon-arrow-down"></i>&nbsp;&nbsp;快速授权
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">用户权限</label>
                                                <div class="col-sm-10">
                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单模块
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单编辑
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                                   checked="checked"> 订单查询
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单添加
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单删除
                                                        </label>
                                                    </div>
                                                    <div style="margin-top: 20px;"></div>

                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单模块
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单编辑
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                                   checked="checked"> 订单查询
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单添加
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单删除
                                                        </label>
                                                    </div>
                                                    <div style="margin-top: 20px;"></div>

                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单模块
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单编辑
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                                   checked="checked"> 订单查询
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单添加
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单删除
                                                        </label>
                                                    </div>
                                                    <div style="margin-top: 20px;"></div>

                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单模块
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单编辑
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                                   checked="checked"> 订单查询
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单添加
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单删除
                                                        </label>
                                                    </div>
                                                    <div style="margin-top: 20px;"></div>

                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单模块
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                                   checked="checked"> 订单编辑
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                                   checked="checked"> 订单查询
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单添加
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="i-checks">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                                   checked="checked"> 订单删除
                                                        </label>
                                                    </div>
                                                    <div style="margin-top: 20px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">安全密码</label>
                                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard">
                                            <li class="previous">
                                                <button type="button" class="btn btn-primary"><i
                                                            class="icon-arrow-left"></i>&nbsp;&nbsp;上一步
                                                </button>
                                            </li>
                                            <li class="next">
                                                <button type="button" class="btn btn-primary">下一步&nbsp;&nbsp;<i
                                                            class="icon-arrow-right"></i></button>
                                            </li>
                                            <li class="finish">
                                                <button type="button" id="addbtn" class="btn btn-primary">完成&nbsp;&nbsp;<i
                                                            class="icon-arrow-right"></i></button>
                                            </li>
                                        </ul>
                                    </div>
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
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Proxy')}}/js/jquery.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('public/Proxy')}}/js/common-scripts.js"></script>
<script src="{{asset('public/Proxy/library/wizard')}}/js/jquery.bootstrap.wizard.js"></script>
<script src="{{asset('public/Proxy/library/iCheck')}}/js/icheck.min.js"></script>
<script>

    //owl carousel

    $(document).ready(function () {
        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    //custom select box


</script>

</body>
</html>


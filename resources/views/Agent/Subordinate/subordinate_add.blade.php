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
    <link href="{{asset('public/Agent')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="{{asset('public/Agent')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet"/>
    <link href="{{asset('public/Agent')}}/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Agent')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/style-responsive.css" rel="stylesheet"/>
    <link href="{{asset('public/Agent/library/wizard')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Agent/library/iCheck')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Agent/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

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
                            <form method="post" class="form-horizontal" role="form" id="currentForm"
                                  action="{{ url('Agent/ajax/subordinate_add_check') }}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <input type="hidden" id="quick_rule_url" value="{{ url('Agent/ajax/quick_rule') }}">
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
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">手机号码</label>
                                                <div class="col-sm-10"><input type="text" name="mobile"
                                                                              class="form-control"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">用户登录密码</label>
                                                <div class="col-sm-10"><input type="password" name="password"
                                                                              class="form-control"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">重复登录密码</label>
                                                <div class="col-sm-10"><input type="password" name="repassword"
                                                                              class="form-control"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">真实姓名</label>
                                                <div class="col-sm-10"><input type="text" name="realname"
                                                                              class="form-control"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">权限角色</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control m-b" name="role_id" id="role_id">
                                                        <option value="0">请选择</option>
                                                        @foreach($role_list as $k=>$v)
                                                            <option value="{{ $v->id }}">{{ $v->role_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" class="btn btn-primary" onclick="get_quick_rule('#role_id');"><i class="icon-arrow-down"></i>&nbsp;&nbsp;快速授权
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group" id="module_node_box"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">安全密码</label>
                                                <div class="col-sm-10"><input type="password" name="safe_password" class="form-control"></div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard">

                                            <li class="previous">
                                                <button type="button" class="btn btn-primary"><i class="icon-arrow-left"></i>&nbsp;&nbsp;上一步
                                                </button>
                                            </li>

                                            <li class="next">
                                                <button type="button" class="btn btn-primary">下一步&nbsp;&nbsp;<i class="icon-arrow-right"></i></button>
                                            </li>
                                            <li class="finish">
                                                <button type="button" id="addbtn" class="btn btn-primary" onclick="return postForm();">完成&nbsp;&nbsp;<i class="icon-arrow-right"></i></button>
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
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Agent')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('public/Agent')}}/js/common-scripts.js"></script>
<script src="{{asset('public/Agent/library/wizard')}}/js/jquery.bootstrap.wizard.js"></script>
<script src="{{asset('public/Agent/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Agent/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Agent/library/wizard')}}/js/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('public/Agent/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        get_quick_rule('#role_id');
    });
    //获取上级程序节点
    function get_quick_rule(obj) {
        var url = $('#quick_rule_url').val();
        var token = $('#_token').val();
        var role_id = $(obj).val();
        var data = {'_token': token, 'role_id': role_id}
        $.post(url, data, function (response) {
            $('#module_node_box').html(response);
        });
    }
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if (json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
            } else {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                });
            }
        });
    }
</script>
</body>
</html>


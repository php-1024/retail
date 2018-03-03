<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Catering')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Catering')}}/wizard/css/custom.css" rel="stylesheet" />
    <link href="{{asset('public/Catering')}}/iCheck/css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Catering')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Catering')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Catering')}}/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        @include('Catering/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        @include('Catering/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">下属添加</h3>
                        </div>
                        <section class="panel">
                            <header class="panel-heading">
                                添加下级人员
                            </header>
                            <div class="panel-body">
                                <form  method="post" class="form-horizontal" id="currentForm" action="{{ url('catering/ajax/subordinate_add_check') }}">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <input type="hidden" id="quick_rule_url" value="{{ url('catering/ajax/quick_rule') }}">
                                    <div id="rootwizard">
                                        <ul class="bwizard-steps">
                                            <li class="active"><a href="#tab1" data-toggle="tab"><span style="color:#999;" class="label">1</span> 填写基础资料</a></li>
                                            <li class=""><a href="#tab2" data-toggle="tab"><span style="color:#999;" class="label">2</span> 指派权限</a></li>
                                        </ul>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">手机号码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control" name="mobile"></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">用户密码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control" name="password"></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">重复密码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control" name="repassword"></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">真实姓名</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control" name="realname"></div>
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
                                                    <div class="col-sm-2"><button type="button" class="btn btn-success" onclick="get_quick_rule('#role_id');"><i class="icon-arrow-down"></i>&nbsp;&nbsp;快速授权</button></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                                <div class="form-group" id="module_node_box"></div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">安全密码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control" name="safe_password"></div>
                                                </div>

                                            </div>

                                            <ul class="pager wizard">

                                                <li class="previous"><button type="button" class="btn btn-success"><i class="icon-arrow-left"></i>&nbsp;&nbsp;上一步</button></li>

                                                <li class="next disabled hidden"><button type="button" class="btn btn-success">下一步&nbsp;&nbsp;<i class="icon-arrow-right"></i></button></li>
                                                <li class="finish"><button type="button" id="addBtn" class="btn btn-success" onclick="return postForm();">完成&nbsp;&nbsp;<i class="icon-arrow-right"></i></button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<script src="{{asset('public/Catering')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Catering')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Catering')}}/js/app.js"></script>
<script src="{{asset('public/Catering')}}/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Catering')}}/js/app.plugin.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/wizard/js/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('public/Catering')}}/iCheck/js/icheck.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        get_quick_rule('#role_id');

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
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

























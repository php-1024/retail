<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>下属添加 | 零壹云管理平台 | 分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch/library')}}/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch/library')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Branch/library')}}/wizard/css/custom.css" rel="stylesheet" />
    <link href="{{asset('public/Branch/library')}}/iCheck/css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch/library')}}/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    {{--头部--}}
    @include('Branch/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('Branch/Public/Nav')
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
                                <form method="get" class="form-horizontal">
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
                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">用户密码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">重复密码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
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
                                                            <option>总分店管理员</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2"><button type="button" class="btn btn-success"><i class="icon-arrow-down"></i>&nbsp;&nbsp;快速授权</button></div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">用户权限</label>
                                                    <div class="col-sm-10">
                                                        <div class="panel-body">
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
                                                            <div class="line line-dashed b-b line-lg pull-in"></div>

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
                                                            <div class="line line-dashed b-b line-lg pull-in"></div>

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
                                                            <div class="line line-dashed b-b line-lg pull-in"></div>

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
                                                            <div class="line line-dashed b-b line-lg pull-in"></div>

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
                                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">安全密码</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>

                                            </div>

                                            <ul class="pager wizard">

                                                <li class="previous"><button type="button" class="btn btn-success"><i class="icon-arrow-left"></i>&nbsp;&nbsp;上一步</button></li>

                                                <li class="next disabled hidden"><button type="button" class="btn btn-success">下一步&nbsp;&nbsp;<i class="icon-arrow-right"></i></button></li>
                                                <li class="finish"><button type="button" id="addBtn" class="btn btn-success">完成&nbsp;&nbsp;<i class="icon-arrow-right"></i></button></li>
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
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch/library')}}/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch/library')}}/file-input/bootstrap-filestyle.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Branch/library')}}/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('public/Branch/library')}}/wizard/js/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('public/Branch/library')}}/iCheck/js/icheck.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });

        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

    });
</script>
</body>
</html>

























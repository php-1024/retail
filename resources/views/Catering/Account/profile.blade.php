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
    <link href="{{asset('public/Catering')}}/iCheck/css/custom.css" rel="stylesheet" />
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
                            <h3 class="m-b-none">账号信息</h3>
                        </div>

                        <div class="col-lg-4">
                            <section class="panel panel-default">
                                <header class="panel-heading font-bold">
                                    个人账号信息修改
                                </header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="get">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">用户账号</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1" disabled="" value="200307">
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">真实姓名</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1"  value="薛志豪">
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">手机号码</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1" value="13123456789">
                                                <span class="help-block m-b-none">该手机号码可用作登录，与负责人手机号码可分别设置</span>
                                            </div>

                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">安全密码</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1" value="">
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>

                                        <div class="form-group">
                                            <div class="col-sm-12 col-sm-offset-5">

                                                <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                    </form>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-8">
                            <section class="panel panel-default">
                                <header class="panel-heading font-bold">
                                    个人系统权限
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
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                            </section>
                        </div>
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
<script src="{{asset('public/Catering')}}/iCheck/js/icheck.min.js"></script>
<script>
    $(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('select.styled').customSelect();
    });
</script>
</body>
</html>

























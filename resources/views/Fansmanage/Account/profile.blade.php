<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Fansmanage')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Fansmanage')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Fansmanage')}}/iCheck/css/custom.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Fansmanage')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Fansmanage')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Fansmanage')}}/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        @include('Fansmanage/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        {{--@include('Fansmanage/Public/Nav')--}}
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
                                    <form class="form-horizontal" method="post" id="currentForm" action="{{ url('catering/ajax/profile_check') }}">
                                        <input type="hidden" name="_token"  value="{{csrf_token()}}">
                                        <input type="hidden" name="id" value="{{$user['id']}}">
                                        <input type="hidden" name="organization_id" value="{{$user['organization_id']}}">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">用户账号</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1" disabled="" value="{{$user['account']}}">
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">真实姓名</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1"  value="{{$user['account_info']['realname']}}" name="realname">
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">手机号码</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1" value="{{$user['mobile']}}" name="mobile">
                                                <span class="help-block m-b-none">该手机号码可用作登录，与负责人手机号码可分别设置</span>
                                            </div>

                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="input-id-1">安全密码</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="input-id-1" name="safe_password" >
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>

                                        <div class="form-group">
                                            <div class="col-sm-12 col-sm-offset-5">

                                                <button type="button" onclick="postForm()" class="btn btn-success" id="addBtn">保存信息</button>
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
                                    @foreach($module_node_list as $key=>$val)
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> {{ $val['module_name'] }}
                                        </label>
                                    </div>
                                    <div>
                                        @foreach($val['program_nodes'] as $kk=>$vv)
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" disabled=""> {{ $vv['node_name'] }}
                                        </label>
                                        &nbsp;&nbsp;
                                        @endforeach
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<script src="{{asset('public/Fansmanage')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Fansmanage')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Fansmanage')}}/js/app.js"></script>
<script src="{{asset('public/Fansmanage')}}/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Fansmanage')}}/js/app.plugin.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/js/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Fansmanage')}}/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('public/Fansmanage')}}/iCheck/js/icheck.min.js"></script>
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
                    confirmButtonText: "确定"
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定"
                });
            }
        });
    }

    //custom select box
    $(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });

</script>
</body>
</html>

























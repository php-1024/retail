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
    <!--[if lt IE 9]>
    <script src="{{asset('public/Catering')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Catering')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Catering')}}/js/ie/excanvas.js"></script>
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
                        @include('Fansmanage/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">创建总分店</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                创建总分店
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" id="currentForm" action="{{ url('fansmanage/ajax/branch_create_check') }}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">模式</label>
                                        <div class="col-sm-10">
                                            <div class="btn-group" data-toggle="buttons">
                                                @foreach($package_program as $key=>$val)
                                                    @foreach($val->programs as $kk=>$vv)
                                                        <label class="btn btn-sm btn-success" style="margin-right: 10px;">
                                                            <input type="radio" name="program_id" value="{{$vv->id}}"><i class="fa fa-check text-active"></i>{{$vv->program_name}}
                                                        </label>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">类型</label>
                                        <div class="col-sm-10">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if($onebranch != 'true')
                                                    <label class="btn btn-sm btn-success active">
                                                        <input type="radio" name="type" value="0" checked="checked"><i class="fa fa-check text-active"></i> 总店
                                                    </label>
                                                @else
                                                    <label class="btn btn-sm btn-info active" style="margin-left: 10px;">
                                                        <input type="radio" name="type" value="1" checked="checked"><i class="fa fa-check text-active"></i> 分店
                                                    </label>
                                                @endif
                                            </div>
                                            <span class="help-block m-b-none">创建的首个分店默认为总店，其他默认为分店</span>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">分店名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"  name="organization_name" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">负责人手机号码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="" name="mobile">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">负责人姓名</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="" name="realname">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">登陆密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="" name="password">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">重复密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="" name="re_password">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="" name="safe_password" >
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-5">
                                            <button type="button" class="btn btn-default" onclick="history.back()">返回</button>
                                            <button type="button" class="btn btn-success" id="addBtn" onclick="return postForm();">保存信息</button>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
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
                console.log(json);
//                swal({
//                    title: "提示信息",
//                    text: json.data,
//                    confirmButtonColor: "#DD6B55",
//                    confirmButtonText: "确定"
//                });
            }
        });
    }
</script>
</body>
</html>

























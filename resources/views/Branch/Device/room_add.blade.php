<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 分店业务系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Branch')}}/library/wizard/css/custom.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch')}}/library/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/excanvas.js"></script>
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
                            <h3 class="m-b-none">添加包厢</h3>
                        </div>
                        <section class="panel panel-default">

                            <header class="panel-heading font-bold">
                                添加包厢
                            </header>
                            <div class="panel-body">
                                <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('branch/ajax/room_add_check') }}">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="organization_id" id="organization_id" value="{{$admin_data['organization_id']}}">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">包厢名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="room_name" value="">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="safe_password" value="">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-6">

                                            <button type="button" class="btn btn-success" onclick="postForm()">保存信息</button>
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
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch/library')}}/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch/library')}}/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch/library')}}/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch/library')}}/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch/library')}}/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
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
                    confirmButtonText: "确定"
                });
            }
        });
    }
</script>
</body>
</html>
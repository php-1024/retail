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
                        @include('Fansmanage/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">粉丝用户足迹</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                粉丝用户足迹
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <label class="col-sm-1 control-label">用户账号</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="input-id-1" value="" placeholder="用户账号">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" id="addBtn" class="btn btn-s-md btn-info"><i class="icon icon-magnifier"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                                </form>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="wrapper col-lg-12" style="background: #FFFFFF;">
                                <section class="comment-list block">

                                    @foreach($list as $key=>$value)
                                    <article id="comment-id-3" class="comment-item">
                                        <span class="pull-left thumb-sm avatar"><img src="{{asset('public/Fansmanage')}}/img/a9.png" alt="..."></span>
                                        <span class="arrow left"></span>
                                        <section class="comment-body panel panel-default">
                                            <header class="panel-heading">
                                                <a href="#">{{$value->User->account}}</a>
                                                <label class="label bg-success m-l-xs">{{$value->nickname}}</label>
                                                <span class="text-muted m-l-sm pull-right">
                              <i class="fa fa-clock-o"></i>
                              {{$value->created_at}}
                            </span>
                                            </header>
                                            <div class="panel-body">
                                                <div>{{$value->log_info}}</div>
                                            </div>
                                        </section>
                                    </article>
                                    @endforeach
                        </section>
                        </div>
                    </section>
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#save_btn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
</script>
</body>
</html>

























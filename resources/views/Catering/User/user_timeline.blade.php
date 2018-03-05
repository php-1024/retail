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

                                    <article id="comment-id-3" class="comment-item">
                                        <span class="pull-left thumb-sm avatar"><img src="images/a9.png" alt="..."></span>
                                        <span class="arrow left"></span>
                                        <section class="comment-body panel panel-default">
                                            <header class="panel-heading">
                                                <a href="#">100020</a>
                                                <label class="label bg-success m-l-xs">时光取名叫无心</label>
                                                <span class="text-muted m-l-sm pull-right">
                              <i class="fa fa-clock-o"></i>
                              2018-01-29 11:11:11
                            </span>
                                            </header>
                                            <div class="panel-body">
                                                <div>为订单1000020003004000付款了100元，扣除联盟分润18元，您实际收入82元</div>
                                            </div>
                                        </section>
                                    </article>
                                    <article id="comment-id-3" class="comment-item">
                                        <span class="pull-left thumb-sm avatar"><img src="images/a9.png" alt="..."></span>
                                        <span class="arrow left"></span>
                                        <section class="comment-body panel panel-default">
                                            <header class="panel-heading">
                                                <a href="#">100020</a>
                                                <label class="label bg-success m-l-xs">时光取名叫无心</label>
                                                <span class="text-muted m-l-sm pull-right">
                              <i class="fa fa-clock-o"></i>
                              2018-01-29 11:11:11
                            </span>
                                            </header>
                                            <div class="panel-body">
                                                <div>提交了订单：1000020003004000</div>
                                            </div>
                                        </section>
                                    </article>
                                    <article id="comment-id-3" class="comment-item">
                                        <span class="pull-left thumb-sm avatar"><img src="images/a9.png" alt="..."></span>
                                        <span class="arrow left"></span>
                                        <section class="comment-body panel panel-default">
                                            <header class="panel-heading">
                                                <a href="#">100020</a>
                                                <label class="label bg-success m-l-xs">时光取名叫无心</label>
                                                <span class="text-muted m-l-sm pull-right">
                              <i class="fa fa-clock-o"></i>
                              2018-01-29 11:11:11
                            </span>
                                            </header>
                                            <div class="panel-body">
                                                <div>进入了本店</div>
                                            </div>
                                        </section>
                                    </article>
                                    <article id="comment-id-3" class="comment-item">
                                        <span class="pull-left thumb-sm avatar"><img src="images/a9.png" alt="..."></span>
                                        <span class="arrow left"></span>
                                        <section class="comment-body panel panel-default">
                                            <header class="panel-heading">
                                                <a href="#">100020</a>
                                                <label class="label bg-success m-l-xs">时光取名叫无心</label>
                                                <span class="text-muted m-l-sm pull-right">
                              <i class="fa fa-clock-o"></i>
                              2018-01-29 11:11:11
                            </span>
                                            </header>
                                            <div class="panel-body">
                                                <div>关注了公众号</div>
                                            </div>
                                        </section>
                                    </article>
                                </section>
                        </section>
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

























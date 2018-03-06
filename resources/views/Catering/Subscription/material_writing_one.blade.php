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
    <link href="{{asset('public/Catering')}}/ladda/ladda-themeless.min.css" rel="stylesheet">
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
                <section class="hbox stretch">
                    <!-- side content -->
                    <aside class="aside bg-dark" id="sidebar">
                        <section class="vbox animated fadeInUp">
                            <section class="scrollable hover">
                                <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                                    <a href="subscription_material.html" class="list-group-item">
                                        图片素材
                                    </a>
                                    <a href="subscription_material2.html" class="list-group-item active">
                                        图文素材
                                    </a>

                                </div>
                            </section>
                        </section>
                    </aside>
                    <!-- / side content -->
                    <section>
                        <section class="vbox">
                            <section class="scrollable padder-lg">
                                <h2 class="font-thin m-b">添加单条图文</h2>
                                <div class="row row-sm">
                                    <button class="btn btn-s-md btn-success" type="button" onclick="location.href='subscription_material2.html'" id="addBtn"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">
                                        添加单条图文
                                    </header>
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="get">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">图片</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">标题</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="input-id-1" value="">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">作者</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="input-id-1" value="">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">摘要</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">正文</label>
                                                <div class="col-sm-10">
                                                    <textarea id="form-content" class="editor" cols="30" rows="10"> </textarea>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>

                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-6">

                                                    <button type="button" class="btn btn-success" id="save_btn">保存信息</button>
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
    </section>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">选择添加类型</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <button class="btn btn-info" type="button" onclick="location.href='{{url('catering/subscription/subscription_material3')}}'"><i class="fa fa-circle"></i>&nbsp;&nbsp;单条图文</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-info" type="button" onclick="location.href='{{url('catering/subscription/subscription_material4')}}'"><i class="fa fa-list-ul"></i>&nbsp;&nbsp;多条图文</button>
                    </div>
                    <div style="clear:both;"></div>
                </div>

            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">删除图文消息确定</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                            </div>
                        </div>
                        <div style="clear:both;"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="save_btn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script src="{{asset('public/Catering')}}/js/file-input/bootstrap-filestyle.min.js"></script>

<script type="text/javascript">
    $(function(){
        $('#deleteBtn').click(function(){
            $('#myModal2').modal();
        });

        $('#addBtn').click(function(){
            $('#myModal').modal();
        });
    });
</script>
</body>
</html>

























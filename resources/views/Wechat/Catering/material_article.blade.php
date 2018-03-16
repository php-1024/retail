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
                                    <a href="{{url('catering/subscription/material_image')}}" class="list-group-item">
                                        图片素材
                                    </a>
                                    <a href="{{url('catering/subscription/material_writing')}}" class="list-group-item active">
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
                                <h2 class="font-thin m-b">图文素材</h2>
                                <div class="row row-sm">
                                    <button class="btn btn-s-md btn-success" type="button" id="addBtn">添加图文 &nbsp;&nbsp;<i class="fa fa-plus"></i></button>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                                <section class="panel panel-default">
                                    <header class="panel-heading">
                                        图文素材列表
                                    </header>

                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>素材标题</th>
                                                <th>素材类型</th>
                                                <th>添加时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>测试图文</td>
                                                <td>单条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" onclick="location.href='{{url('catering/subscription/material_writing_one_edit')}}'"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>测试图文</td>
                                                <td>多条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" onclick="location.href='{{url('catering/subscription/material_writing_many_edit')}}'"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>测试图文</td>
                                                <td>单条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>测试图文</td>
                                                <td>单条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>测试图文</td>
                                                <td>单条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>测试图文</td>
                                                <td>单条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">

                                            <div class="col-sm-12 text-right text-center-xs">
                                                <ul class="pagination pull-right">
                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="first" href="#first">«</a>
                                                    </li>

                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="prev" href="#prev">‹</a>
                                                    </li>
                                                    <li class="footable-page active">
                                                        <a data-page="0" href="#">1</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">2</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">3</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">4</a>
                                                    </li>
                                                    <li class="footable-page">
                                                        <a data-page="1" href="#">5</a>
                                                    </li>
                                                    <li class="footable-page-arrow">
                                                        <a data-page="next" href="#next">›</a>
                                                    </li>
                                                    <li class="footable-page-arrow">
                                                        <a data-page="last" href="#last">»</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </footer>
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
                        <button class="btn btn-info" type="button" onclick="location.href='{{url('catering/subscription/material_writing_one')}}'"><i class="fa fa-circle"></i>&nbsp;&nbsp;单条图文</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-info" type="button" onclick="location.href='{{url('catering/subscription/material_writing_many')}}'"><i class="fa fa-list-ul"></i>&nbsp;&nbsp;多条图文</button>
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
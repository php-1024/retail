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
                                                    <button class="btn btn-info btn-xs" onclick="location.href='subscription_material5.html'"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>测试图文</td>
                                                <td>多条图文</td>
                                                <td>2017-08-09 11:11:11</td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" onclick="location.href='subscription_material6.html'"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
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
                    <h4 class="modal-title">上传本地图片</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">

                        <div class="form-group">
                            <label class="col-sm-2 text-right">本地图片</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                            </div>
                        </div>

                        <div style="clear:both;"></div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="ladda-button btn btn-success" type="button" data-style="expand-right"><span class="ladda-label">提交</span><span class="ladda-spinner"></span></button>
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






<!-- Ladda -->
<script src="{{asset('public/Catering')}}/ladda/spin.min.js"></script>
<script src="{{asset('public/Catering')}}/ladda/ladda.min.js"></script>
<script src="{{asset('public/Catering')}}/ladda/ladda.jquery.min.js"></script>

<script type="text/javascript">
    $(function(){
        var l = $( '.ladda-button' ).ladda();
        l.click(function(){

            // Start loading
            l.ladda( 'start' );
            setTimeout(function(){
                l.ladda('stop');
            },12000);
        });

        $('#addBtn').click(function(){
            $('#myModal').modal();
        });
    });
</script>
</body>
</html>

























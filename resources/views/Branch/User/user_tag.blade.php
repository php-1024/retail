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
                            <h3 class="m-b-none">粉丝标签管理</h3>
                        </div>

                        <section class="panel panel-default">
                            <header class="panel-heading">
                                粉丝标签管理
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div class="col-sm-12">
                                        <button type="button" id="addBtn" class="btn btn-s-md btn-info"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加粉丝标签</button>
                                        <button type="button" class="btn btn-s-md btn-info"><i class="icon icon-cloud-download"></i>&nbsp;&nbsp;同步微信标签到本地</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>标签名称</th>
                                        <th>标签粉丝数</th>
                                        <th>操作时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>广东粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>河南粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>广西粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>湖南粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>吉林粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加粉丝标签</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">标签名称</label>
                            <div class="col-sm-10">
                                <input type="text" value="标签名称" placeholder="标签名称" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
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
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑粉丝标签</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">标签名称</label>
                            <div class="col-sm-10">
                                <input type="text" value="标签名称" placeholder="标签名称" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
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
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">删除粉丝标签确定</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
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
<!-- App -->
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/library/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch')}}/library/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/wizard/js/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#addBtn').click(function(){
            $('#myModal').modal();
        });
        $('#editBtn').click(function(){
            $('#myModal2').modal();
        });
        $('#deleteBtn').click(function(){
            $('#myModal3').modal();
        });
    });
</script>
</body>
</html>
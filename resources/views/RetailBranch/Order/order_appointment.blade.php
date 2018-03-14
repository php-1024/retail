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
    @include('RetailBranch/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('RetailBranch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">预约就餐</h3>
                        </div>

                        <section class="panel panel-default">
                            <header class="panel-heading">
                                预约就餐
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
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>微信头像</th>
                                        <th>用户账号</th>
                                        <th>微信昵称</th>
                                        <th>预约姓名</th>
                                        <th>预约手机号</th>
                                        <th>预约时间段</th>
                                        <th>状态</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="{{asset('public/Branch')}}/images/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100020</td>
                                        <td>时光取名叫无心</td>
                                        <td>李健瑚</td>
                                        <td>13123456789</td>
                                        <td>
                                            <label class="label label-info">2018-02-02 11:11:11</label>&nbsp;&nbsp;到
                                            <label class="label label-info">2018-02-02 14:11:11</label>
                                        </td>
                                        <td>
                                            <label class="label label-info">预约中</label>
                                        </td>
                                        <td>2017-10-22 10:11:11</td>
                                        <td>
                                            <button class="btn btn-success btn-xs" id="okBtn"><i class="fa fa-check"></i>&nbsp;&nbsp;确认到店</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;取消预约</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><img src="{{asset('public/Branch')}}/images/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100020</td>
                                        <td>时光取名叫无心</td>
                                        <td>李健瑚</td>
                                        <td>13123456789</td>
                                        <td>
                                            <label class="label label-info">2018-02-02 11:11:11</label>&nbsp;&nbsp;到
                                            <label class="label label-info">2018-02-02 14:11:11</label>
                                        </td>
                                        <td>
                                            <label class="label label-default">取消预约</label>
                                        </td>
                                        <td>2017-10-22 10:11:11</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><img src="{{asset('public/Branch')}}/images/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100020</td>
                                        <td>时光取名叫无心</td>
                                        <td>李健瑚</td>
                                        <td>13123456789</td>
                                        <td>
                                            <label class="label label-info">2018-02-02 11:11:11</label>&nbsp;&nbsp;到
                                            <label class="label label-info">2018-02-02 14:11:11</label>
                                        </td>
                                        <td>
                                            <label class="label label-success">确认到店</label>
                                        </td>
                                        <td>2017-10-22 10:11:11</td>
                                        <td>
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
                    <h4 class="modal-title">确认取消预约</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="addBtn">确定</button>
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
                    <h4 class="modal-title">确认预约到店</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="addBtn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
    $(document).ready(function() {
        $('#deleteBtn').click(function(){
            $('#myModal').modal();
        });
        $('#okBtn').click(function(){
            $('#myModal2').modal();
        });
    });
</script>
</body>
</html>
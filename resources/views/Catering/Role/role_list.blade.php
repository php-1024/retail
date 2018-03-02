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
    <link href="{{asset('public/Catering')}}/iCheck/css/custom.css" rel="stylesheet" />
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
                            <h3 class="m-b-none">角色列表</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                角色列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <label class="col-sm-1 control-label">角色名称</label>

                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="">
                                    </div>

                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>角色名称</th>
                                        <th>角色权限</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>财务管理员</td>
                                        <td>
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>财务管理员</td>
                                        <td>
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>财务管理员</td>
                                        <td>
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>财务管理员</td>
                                        <td>
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                            <button data-original-title="订单模块" data-content="订单添加  订单删除  订单查看 订单编辑" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">订单模块</button>&nbsp;&nbsp;
                                        </td>
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
div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form class="form-horizontal tasi-form" method="get">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">店铺信息编辑</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">角色名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-id-1" value="">
                        </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">角色权限</label>
                        <div class="col-sm-10">
                            <div class="panel-body">
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                    </label>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                    </label>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                    </label>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                    </label>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单模块
                                    </label>
                                </div>
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" value="option1" id="inlineCheckbox1" checked="checked" > 订单编辑
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option2" id="inlineCheckbox2" checked="checked" > 订单查询
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单添加
                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="i-checks">
                                        <input type="checkbox" value="option3" id="inlineCheckbox3" checked="checked" > 订单删除
                                    </label>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>
                            </div>
                        </div>
                    </div>


                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-id-1" value="">
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

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
                    <h4 class="modal-title">确认删除角色</h4>
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
<script type="text/javascript" src="{{asset('public/Catering')}}/iCheck/js/icheck.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#deleteBtn').click(function(){
            $('#myModal2').modal();
        });
        $('.popovers').popover();
    });
</script>
</body>
</html>

























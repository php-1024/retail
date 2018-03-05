<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>下属列表 | 零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch/library')}}/jPlayer/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css"/>
    <link href="{{asset('public/Branch/library')}}/sweetalert/sweetalert.css" rel="stylesheet"/>
    <link href="{{asset('public/Branch/library')}}/iCheck/css/custom.css" rel="stylesheet"/>
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch/library')}}/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/excanvas.js"></script>
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
                            <h3 class="m-b-none">下属列表</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                下属列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <input type="hidden" id="subordinate_edit_url" value="{{ url('branch/ajax/subordinate_edit') }}">
                                    <input type="hidden" id="subordinate_lock" value="{{ url('branch/ajax/subordinate_lock') }}">
                                    <input type="hidden" id="subordinate_delete" value="{{ url('branch/ajax/subordinate_delete') }}">
                                    <input type="hidden" id="subordinate_authorize_url" value="{{ url('branch/ajax/subordinate_authorize') }}">
                                    <label class="col-sm-1 control-label">下属账号</label>

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
                                        <th>用户账号</th>
                                        <th>用户角色</th>
                                        <th>微信头像</th>
                                        <th>微信昵称</th>
                                        <th>真实姓名</th>
                                        <th>手机号码</th>
                                        <th>用户状态</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $key=>$val)
                                        <tr>
                                            <td>{{ $val->id }}</td>
                                            <td>{{ $val->account }}</td>
                                            <td>@foreach($val->account_roles as $k=>$v) {{$v->role_name}} @endforeach</td>
                                            <td>
                                                <img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;">
                                            </td>
                                            <td>
                                                时光取名叫无心
                                            </td>
                                            <td>@if(!empty($val->account_info)){{$val->account_info->realname }}@else <label class="label label-danger">未绑定</label> @endif</td>
                                            <td>{{ $val->mobile }}</td>
                                            <td>
                                                @if($val->status == '1')
                                                    <label class="label label-success">正常</label>
                                                @else
                                                    <label class="label label-warning">已冻结</label>
                                                @endif
                                            </td>
                                            <td>{{ $val->created_at }}</td>
                                            <td>
                                                <button class="btn btn-info btn-xs" id="editBtn" onclick="getEditForm({{ $val->id }})"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                <button type="button" id="ruleBtn" class="btn  btn-xs btn-primary" onclick="getAuthorizeForm({{ $val->id }})"><i class="fa fa-certificate"></i>&nbsp;&nbsp;授权</button>
                                                @if($val->status=='1')
                                                    <button type="button" id="lockBtn" class="btn  btn-xs btn-warning" onclick="getLockComfirmForm('{{ $val->id }}','{{ $val->account }}','{{ $val->status }}')"><i class="icon icon-lock"></i>&nbsp;&nbsp;冻结</button>
                                                @else
                                                    <button type="button" id="lockBtn" class="btn  btn-xs btn-success" onclick="getLockComfirmForm('{{ $val->id }}','{{ $val->account }}','{{ $val->status }}')"><i class="icon icon-lock"></i>&nbsp;&nbsp;解冻</button>
                                                @endif
                                                {{--<button class="btn btn-danger btn-xs" id="deleteBtn" onclick="getDeleteComfirmForm('{{ $val->id }}','{{ $val->account }}')"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">

                                    <div class="col-sm-12 text-right text-center-xs">
                                        <ul class="pagination pull-right">
                                            {{ $list->appends($search_data)->links() }}
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
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑用户基本信息</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">用户账号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="100021">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">真实姓名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">手机号码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
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
                    <h4 class="modal-title">确认冻结/解冻操作</h4>
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

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑用户基本信息</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限角色</label>
                            <div class="col-sm-3">
                                <select class="form-control m-b" name="account">
                                    <option>订单管理员</option>
                                    <option>装修员</option>
                                    <option>客服人员</option>
                                    <option>总分店管理员</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success"><i class="icon-arrow-down"></i>&nbsp;&nbsp;快速授权
                                </button>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户权限</label>
                            <div class="col-sm-10">
                                <div class="panel-body">
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单模块
                                        </label>
                                    </div>
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单编辑
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                   checked="checked"> 订单查询
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单添加
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单删除
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单模块
                                        </label>
                                    </div>
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单编辑
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                   checked="checked"> 订单查询
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单添加
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单删除
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单模块
                                        </label>
                                    </div>
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单编辑
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                   checked="checked"> 订单查询
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单添加
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单删除
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单模块
                                        </label>
                                    </div>
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单编辑
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                   checked="checked"> 订单查询
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单添加
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单删除
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单模块
                                        </label>
                                    </div>
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1"
                                                   checked="checked"> 订单编辑
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option2" id="inlineCheckbox2"
                                                   checked="checked"> 订单查询
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单添加
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="i-checks">
                                            <input type="checkbox" value="option3" id="inlineCheckbox3"
                                                   checked="checked"> 订单删除
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">安全密码</label>
                            <div class="col-sm-10"><input type="text" class="form-control"></div>
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
<script src="{{asset('public/Branch/library')}}/jPlayer/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Branch/library')}}/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('public/Branch/library')}}/iCheck/js/icheck.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#editBtn').click(function () {

            $('#myModal').modal();
        });

        $('#ruleBtn').click(function () {
            $('#myModal4').modal();
        });

        $('#lockBtn').click(function () {

            $('#myModal2').modal();
        });
        $('#deleteBtn').click(function () {
            $('#myModal3').modal();
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('#addBtn').click(function () {
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });

    //冻结用户-解冻
    function getLockComfirmForm(id, account, status) {
        var url = $('#subordinate_lock').val();
        var token = $('#_token').val();

        if (id == '') {
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            }, function () {
                window.location.reload();
            });
            return;
        }

        var data = {'id': id, 'account': account, 'status': status, '_token': token};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }

    //获取用户信息，编辑密码框
    function getAuthorizeForm(id) {
        var url = $('#subordinate_authorize_url').val();
        var token = $('#_token').val();

        if (id == '') {
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            }, function () {
                window.location.reload();
            });
            return;
        }

        var data = {'id': id, '_token': token};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }

    //获取用户信息，编辑密码框
    function getEditForm(id) {
        var url = $('#subordinate_edit_url').val();
        var token = $('#_token').val();

        if (id == '') {
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            }, function () {
                window.location.reload();
            });
            return;
        }

        var data = {'id': id, '_token': token};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>
</body>
</html>

























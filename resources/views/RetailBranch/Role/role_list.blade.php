<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>角色列表 | 零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch/library')}}/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch/library')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Branch/library')}}/iCheck/css/custom.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch/library')}}/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/excanvas.js"></script>
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
                            <h3 class="m-b-none">角色列表</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                角色列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get" id="searchForm" action="">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <input type="hidden" id="role_edit_url" value="{{ url('cateringbranch/ajax/role_edit') }}">
                                    <input type="hidden" id="role_delete_comfirm_url"
                                           value="{{ url('cateringbranch/ajax/role_delete') }}">
                                    <label class="col-sm-1 control-label">角色名称</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" id="role_name"
                                               name="role_name" value="{{ $search_data['role_name'] }}">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索
                                        </button>
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
                                    @foreach($list as $key=>$val)
                                        <tr>
                                            <td>{{ $val->id }}</td>
                                            <td>{{ $val->role_name }}</td>
                                            <td>
                                                @foreach($role_module_nodes[$val->id] as $k=>$v)
                                                    <button data-original-title="{{$k}}" data-content="@foreach($v as $kk=>$vv) {{$vv}} @endforeach" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">{{$k}}</button>&nbsp;&nbsp;&nbsp;
                                                @endforeach
                                            </td>
                                            <td>{{ $val->created_at }}</td>
                                            <td>
                                                <button class="btn btn-info btn-xs" id="editBtn"
                                                        onclick="getEditForm({{ $val->id }})"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑
                                                </button>
                                                <button class="btn btn-danger btn-xs" id="deleteBtn"
                                                        onclick="getDeleteComfirmForm({{ $val->id }})"><i
                                                            class="fa fa-times"></i>&nbsp;&nbsp;删除
                                                </button>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

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
    $(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.popovers').popover();
    });

    //获取删除权限角色删除密码确认框
    function getDeleteComfirmForm(id) {
        var url = $('#role_delete_comfirm_url').val();
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
        var url = $('#role_edit_url').val();
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>零壹新科技服务商管理平台</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Proxy')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/Proxy')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Proxy')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('public/Proxy')}}/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Proxy')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/style-responsive.css" rel="stylesheet" />
    <link href="{{asset('public/Proxy/library/iCheck')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Proxy/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Proxy')}}/js/html5shiv.js"></script>
    <script src="{{asset('public/Proxy')}}/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        @include('Proxy/Public/Header')
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        @include('Proxy/Public/Nav')
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-group"></i> 下级人员管理</a></li>
                        <li class="active">权限角色列表</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" method="get" id="searchForm" action="">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <input type="hidden" id="role_edit_url" value="{{ url('proxy/ajax/role_edit') }}">
                                <input type="hidden" id="role_delete_comfirm_url" value="{{ url('proxy/ajax/role_delete') }}">
                                <div class="form-group">
                                    <label class="control-label col-lg-1" for="inputSuccess">角色名称</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" placeholder="角色名称" id="role_name" name="role_name" value="{{ $search_data['role_name'] }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-primary"><i class="icon-search"></i> 查询</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        权限角色列表
                                    </header>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>角色名称</th>
                                            <th>角色创建人</th>
                                            <th>角色权限</th>
                                            <th>添加时间</th>
                                            <th class="text-right">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $key=>$val)
                                        <tr>
                                            <td>{{ $val->id }}</td>
                                            <td>{{ $val->role_name }}</td>
                                            <td>{{ $val->create_account->account }}</td>

                                            <td>
                                                @foreach($role_module_nodes[$val->id] as $k=>$v)
                                                <button data-original-title="订单模块" data-content="@foreach($v as $kk=>$vv){{$vv}}  @endforeach" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">{{$k}}</button>&nbsp;&nbsp;
                                                @endforeach
                                            </td>
                                            <td>{{ $val->created_at }}</td>
                                            <td class="text-right">
                                                <button type="button" class="btn  btn-xs btn-primary"  onclick="getEditForm({{ $val->id }})"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                <button type="button" class="btn  btn-xs btn-danger" onclick="getDeleteComfirmForm({{ $val->id }})"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="99">
                                                <ul class="pagination pull-right">
                                                    {{ $list->appends($search_data)->links() }}
                                                </ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </section>
    </section>
    <!--main content end-->
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Proxy')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{asset('public/Proxy')}}/js/icheck.min.js"></script>

<!--common script for all pages-->
<script src="{{asset('public/Proxy')}}/js/common-scripts.js"></script>
<script src="{{asset('public/Proxy/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script>
    //获取删除权限角色删除密码确认框
    function getDeleteComfirmForm(id){
        var url = $('#role_delete_comfirm_url').val();
        var token = $('#_token').val();
        if(id==''){
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            },function(){
                window.location.reload();
            });
            return;
        }

        var data = {'id':id,'_token':token};
        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
    //获取用户信息，编辑密码框
    function getEditForm(id){
        var url = $('#role_edit_url').val();
        var token = $('#_token').val();

        if(id==''){
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            },function(){
                window.location.reload();
            });
            return;
        }

        var data = {'id':id,'_token':token};
        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>
</body>
</html>


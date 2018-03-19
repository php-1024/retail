<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>零壹新科技服务商管理平台</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Agent')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/Agent')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Agent')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" />
    <link href="{{asset('public/Agent')}}/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/Agent')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Agent')}}/css/style-responsive.css" rel="stylesheet" />
    <link href="{{asset('public/Agent/library/wizard')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Agent/library/iCheck')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Agent/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Agent')}}/js/html5shiv.js"></script>
    <script src="{{asset('public/Agent')}}/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        @include('Agent/Public/Header')
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        @include('Agent/Public/Nav')
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-group"></i> 下级人员列表</a></li>
                        <li class="active">下级人员列表</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" method="get" action="">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <input type="hidden" id="subordinate_edit_url" value="{{ url('Agent/ajax/subordinate_edit') }}">
                                <input type="hidden" id="subordinate_lock" value="{{ url('Agent/ajax/subordinate_lock') }}">
                                <input type="hidden" id="subordinate_delete" value="{{ url('Agent/ajax/subordinate_delete') }}">
                                <input type="hidden" id="subordinate_authorize_url" value="{{ url('Agent/ajax/subordinate_authorize') }}">
                                <div class="form-group">
                                    <label class="control-label col-lg-1" for="inputSuccess">用户账号</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" placeholder="用户账号"  name="account" value="{{ $search_data['account'] }}">
                                    </div>
                                    {{--<label class="control-label col-lg-1" for="inputSuccess">手机号码</label>--}}
                                    {{--<div class="col-lg-2">--}}
                                        {{--<input type="text" class="form-control" placeholder="手机号码">--}}
                                    {{--</div>--}}
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
                                            <th>用户账号</th>
                                            <th>用户角色</th>
                                            <th>真实姓名</th>
                                            <th>手机号码</th>
                                            <th>用户状态</th>
                                            <th>用户层级</th>
                                            <th>添加时间</th>
                                            <th class="text-right">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $key=>$val)
                                        <tr>
                                            <td>{{ $val->id }}</td>
                                            <td>{{ $val->account }}</td>
                                            <td>@foreach($val->account_roles as $k=>$v) {{$v->role_name}} @endforeach</td>
                                            <td>@if(!empty($val->account_info)){{$val->account_info->realname }}@endif</td>
                                            <td>{{ $val->mobile }}</td>
                                            <td>
                                                @if($val->status == '1')
                                                    <label class="label label-success">正常</label>
                                                @else
                                                    <label class="label label-warning">已冻结</label>
                                                @endif
                                                </td>
                                            <td>第{{ $val->deepth }}层</td>

                                            <td>{{ $val->created_at }}</td>
                                            <td class="text-right">
                                                <button type="button" id="editBtn"  class="btn  btn-xs btn-primary" onclick="getEditForm({{ $val->id }})"><i class="icon-edit"></i>&nbsp;&nbsp;编辑用户</button>
                                                <button type="button" id="ruleBtn" class="btn  btn-xs btn-info" onclick="getAuthorizeForm({{ $val->id }})"><i class="icon-certificate"></i>&nbsp;&nbsp;用户授权</button>
                                                @if($val->status=='1')
                                                    <button type="button" id="lockBtn" class="btn  btn-xs btn-success" onclick="getLockComfirmForm('{{ $val->id }}','{{ $val->account }}','{{ $val->status }}')"><i class="icon-lock"></i>&nbsp;&nbsp;冻结用户</button>

                                                @else
                                                    <button type="button" class="btn  btn-xs btn-warning"  onclick="getLockComfirmForm('{{ $val->id }}','{{ $val->account }}','{{ $val->status }}')"><i class="fa fa-lock"></i>&nbsp;&nbsp;解冻用户</button>
                                                @endif

                                                <button type="button" id="deleteBtn" class="btn  btn-xs btn-danger" onclick="getDeleteComfirmForm('{{ $val->id }}','{{ $val->account }}')"><i class="icon-remove"></i>&nbsp;&nbsp;删除用户</button>

                                            </td>
                                        </tr>
                                        @endforeach
                                            <tfoot>
                                            <tr>
                                                <td colspan="99" class="text-right">
                                                    {{ $list->appends($search_data)->links() }}
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
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>

    <!--main content end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Agent')}}/js/jquery.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Agent')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Agent')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{asset('public/Agent')}}/js/common-scripts.js"></script>
<script src="{{asset('public/Agent/library/wizard')}}/js/jquery.bootstrap.wizard.js"></script>
<script src="{{asset('public/Agent/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Agent/library/sweetalert')}}/js/sweetalert.min.js"></script>

<script>

    //owl carousel

    $(document).ready(function() {
        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    //冻结用户-解冻
    function getLockComfirmForm(id,account,status){
        var url = $('#subordinate_lock').val();
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

        var data = {'id':id,'account':account,'status':status,'_token':token};
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
    function getDeleteComfirmForm(id,acconut){
        var url = $('#subordinate_delete').val();
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

        var data = {'id':id,'account':acconut,'_token':token};
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
    function getAuthorizeForm(id){
        var url = $('#subordinate_authorize_url').val();
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
        var url = $('#subordinate_edit_url').val();
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


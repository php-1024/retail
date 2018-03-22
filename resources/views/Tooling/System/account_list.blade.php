<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Tooling/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/font')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/footable')}}/css/footable.core.css" rel="stylesheet">
    <link href="{{asset('public/Tooling')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Tooling')}}/css/style.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Tooling/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Tooling/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>节点列表</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">功能节点管理</a>
                    </li>
                    <li >
                        <strong>节点列表</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">


            <div class="ibox-content m-b-sm border-bottom">
                <form method="get" role="form" action="">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="account_edit_url" value="{{ url('tooling/ajax/account_edit') }}">
                    <input type="hidden" id="account_lock_url" value="{{ url('tooling/ajax/account_lock') }}">
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount">登录账号</label>
                                <input type="text" id="account" name="account" value="{{ $search_data['account'] }}" placeholder="登录账号" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount"> &nbsp;</label>
                                <button type="submit" class="block btn btn-info"><i class="fa fa-search"></i>搜索</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">

                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>登录账号</th>
                                    <th>账号类型</th>
                                    <th>账号状态</th>
                                    <th>添加时间</th>
                                    <th class="text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $ll)
                                <tr>
                                    <td>
                                        {{ $ll->id }}
                                    </td>
                                    <td>
                                        {{ $ll->account }}
                                    </td>
                                    <td>
                                        @if ($ll->is_super==1)
                                            <label class="label label-danger">超级管理员</label>
                                        @else
                                            <label class="label label-info">普通管理员</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ll->status==1)
                                            <label class="label label-primary">正常</label>
                                        @else
                                            <label class="label label-warning">已冻结</label>
                                        @endif
                                    </td>
                                    <td >
                                        {{ $ll->created_at }}
                                    </td>

                                    <td class="text-right">
                                        @if ($admin_data['admin_is_super']==1)
                                            <button type="button" onclick="return getEditForm({{ $ll->id }});" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;修改密码</button>
                                            @if($admin_data['admin_id']==1)
                                                @if($ll->status==1)
                                                    <button type="button" onclick="return lockAccount('{{ $ll->id }}','{{ $ll->account }}','{{  $ll->status }}');" class="btn  btn-xs btn-warning"><i class="fa fa-lock"></i>&nbsp;&nbsp;冻结</button>
                                                 @else
                                                    <button type="button" onclick="return lockAccount('{{ $ll->id }}','{{ $ll->account }}','{{  $ll->status }}');" class="btn  btn-xs btn-primary"><i class="fa fa-unlock"></i>&nbsp;&nbsp;解冻</button>
                                                 @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="99" class="text-right">
                                        {!! $list->appends(['account'=>$search_data['account']])->links() !!}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        @include('Tooling/Public/Footer')
    </div>
</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- Mainly scripts -->
<script src="{{asset('public/Tooling/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Tooling/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Tooling/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Tooling/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Tooling')}}/js/inspinia.js"></script>
<script src="{{asset('public/Tooling/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Tooling/library/sweetalert')}}/js/sweetalert.min.js"></script>
<!-- FooTable -->
<script src="{{asset('public/Tooling/library/footable')}}/js/footable.all.min.js"></script>
<script>
    $(function(){
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    //冻结账号
    function lockAccount(id,account,account_status){
        var url = $('#account_lock_url').val();
        var token = $('#_token').val();
        var data = {'id':id,'account':account,'account_status':account_status,'_token':token};
        $.post(url,data,function(json){
            swal({
                title: "提示信息",
                text: json.data,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            },function(){
                window.location.reload();
            });
            return;
        });
    }
    //获取用户信息，编辑密码框
    function getEditForm(id){
        var url = $('#account_edit_url').val();
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

    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
            }
        });
    }
</script>
</body>

</html>

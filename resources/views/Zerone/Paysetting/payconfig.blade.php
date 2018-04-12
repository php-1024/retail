<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>
    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>收款信息列表</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">收款信息列表</a>
                    </li>
                    <li >
                        <strong>收款信息列表</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
            <input type="hidden" id="payconfig_apply" value="{{ url('zerone/ajax/payconfig_apply') }}">
            <input type="hidden" id="payconfig_type" value="{{ url('zerone/ajax/payconfig_type') }}">

            <div class="ibox-content m-b-sm border-bottom">
                <form method="get" role="form" id="searchForm" action="">
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount">店铺名称</label>
                                <input type="text" id="amount" name="organization_name" value="{{ $search_data['organization_name'] }}" placeholder="请输入店铺名称" class="form-control">
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
                                    <th>店铺名称</th>
                                    <th>pos商户号</th>
                                    <th>盛付通商户号</th>
                                    <th>状态</th>
                                    <th>到账状态</th>
                                    <th class="col-sm-1">注册时间</th>
                                    <th class="col-sm-4 text-right" >操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $key=>$value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->organization->organization_name}}</td>
                                        <td>{{$value->sft_pos_num}}</td>
                                        <td>{{$value->sft_num }}</td>
                                        <td>
                                            @if($value->status == 1)
                                                <label class="label label-primary">已审核</label>
                                            @elseif($value->status == 0)
                                                <label class="label label-warning">未审核</label>
                                            @elseif($value->status == -1)
                                                <label class="label label-danger">未通过</label>
                                            @endif
                                        </td>
                                        <td>
                                            <select style="width:100px" class="dropdown-menu"  onchange="changeUserTag(this,'{{$value->id}}','{{$value->organization->id}}')">
                                                <option @if($value->type == 0) selected @endif value="0">未设置</option>
                                                <option @if($value->type == 1) selected @endif value="1">T0</option>
                                                <option @if($value->type == 2) selected @endif value="2">T1</option>
                                            </select>
                                        </td>
                                        <td>{{ $value->created_at }}</td>
                                        <td class="text-right">
                                            @if($value->status == 0)
                                                <button type="button" id="editBtn" class="btn  btn-xs btn-primary" onclick="getApplyForm('{{ $value->id }}','1','{{$value->organization->id}}')"><i class="fa fa-edit"></i>&nbsp;&nbsp;审核通过</button>
                                            @endif
                                            <button type="button" id="editBtn" class="btn  btn-xs btn-danger" onclick="getApplyForm('{{ $value->id }}','-1','{{$value->organization->id}}')"><i class="fa fa-edit"></i>&nbsp;&nbsp;拒绝通过</button>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="9" class="footable-visible">
                                        <ul class="pagination pull-right">
                                            {{$list->appends($search_data)->links()}}
                                        </ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Zerone/Public/Footer')
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
</div>

{{--<!-- Page-Level Scripts -->--}}
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>

<script src="{{asset('public/Zerone')}}/js/switchery.js"></script>
<script src="{{asset('public/Zerone')}}/js/footable.all.min.js"></script>
<script src="{{asset('public/Zerone')}}/js/bootstrap-datepicker.js"></script>

<script>
    // 审核
    function getApplyForm(id,status,retail_id){
        var url = $('#payconfig_apply').val();
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

        var data = {'id':id,'_token':token,'status':status,'retail_id':retail_id};
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


    // 审核
    function changeUserTag(obj,id,retail_id){

        var type = $(obj).val();
        var url = $('#payconfig_type').val();
        var token = $('#_token').val();

        var data = {'id':id,'_token':token,'type':type,'retail_id':retail_id};

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

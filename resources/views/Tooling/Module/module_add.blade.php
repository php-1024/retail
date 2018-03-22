<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Tooling/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/font')}}/css/font-awesome.css" rel="stylesheet">

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
                <h2>添加模块</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">功能模块管理</a>
                    </li>
                    <li >
                        <strong>添加模块</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>添加模块</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" id="currentForm" action=" {{ url('tooling/ajax/module_add_check') }} ">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-group"><label class="col-sm-2 control-label">模块名称</label>
                                    <div class="col-sm-10"><input type="text" name="module_name" id="module_name" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">模块展示名称</label>
                                    <div class="col-sm-10"><input type="text" name="module_show_name" id="module_show_name" class="form-control"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">模块功能节点</label>
                                    <div class="col-sm-4">
                                        <select name="from" id="multiselect" class="form-control" style="display: inline-block;" size="15" multiple="multiple">
                                            @foreach($node_list as $key=>$val)
                                            <option value="{{ $val->id }}" data-position="{{ $key }}">{{ $val->node_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                    </div>

                                    <div class="col-sm-4">
                                        <select name="nodes[]" id="multiselect_to" class="form-control" size="15" multiple="multiple"></select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group ">
                                    <div class="col-sm-4 col-sm-offset-5">
                                        <button class="btn btn-primary" id="addbtn" type="button" onclick="return postForm();">确认添加</button>&nbsp;&nbsp;
                                        <button class="btn btn-write" onClick="location.href='{{ url('tooling/module/module_list') }}'" type="button">回到列表</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Tooling/Public/Footer')
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/Tooling/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Tooling/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Tooling/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Tooling/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Tooling')}}/js/inspinia.js"></script>
<script src="{{asset('public/Tooling/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Tooling/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Tooling/library/multiselect')}}/js/multiselect.js"></script>

<script>
    $(function(){
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#multiselect').multiselect({keepRenderingSort:true});
    });
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var module_name = $('#module_name').val();
        var module_show_name = $('#module_show_name').val();
        var _token = $('#_token').val();
        var node = '';

        $('#multiselect_to option').each(function(i,v){
            node += 'nodes[]='+$(v).val()+'&';
        });
        node = node.substring(0, node.length-1);
        var data = '_token='+_token+'&module_name='+module_name+'&module_show_name='+module_show_name+'&'+node;
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

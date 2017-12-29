<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Tooling/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/font')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/switchery')}}/css/switchery.css" rel="stylesheet">


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
                <h2>添加程序</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">程序管理</a>
                    </li>
                    <li >
                        <strong>添加程序</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">


            <div class="ibox-content m-b-sm border-bottom">

                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" onclick="location.href='{{ 'tooling/program/program_menu' }}'" class="block btn btn-info"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" id="expand-all" class="block btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;展开所有</button>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" id="collapse-all" class="block btn btn-primary"><i class="fa fa-minus"></i>&nbsp;&nbsp;合并所有</button>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" id="addBtn" class="block btn btn-info"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加菜单</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>"零壹管理程序”菜单结构</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="dd" id="nestable2">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <span class="label label-primary"><i class="fa fa-th-large"></i></span>
                                            <span class="pull-right">
                                                <div class="btn-group">
                                                    <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                    <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                </div>
                                            </span>
                                            系统管理

                                        </div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <span class="label label-primary"><i class="fa fa-th-large"></i></span>
                                            <span class="pull-right">
                                                <div class="btn-group">
                                                    <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                    <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                </div>
                                            </span>
                                            系统管理

                                        </div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <span class="pull-right">
                                                        <div class="btn-group">
                                                            <button type="button" id="editBtn" class="block btn btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑菜单</button>
                                                            <button type="button" id="deleteBtn" class="block btn btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除菜单</button>
                                                        </div>
                                                    </span>
                                                    系统管理
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>


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
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>


<script>
    $(function(){
        get_parents_node($('#complete_id').val());
        new Switchery(document.querySelector('.js-switch'), { color: '#1AB394' });
        new Switchery(document.querySelector('.js-switch2'), { color: '#1AB394' });
        new Switchery(document.querySelector('.js-switch3'), { color: '#1AB394' });
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
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
    //获取上级程序节点
    function get_parents_node(pid){
        var url =  $('#parent_nodes_url').val();
        var token = $('#_token').val();
        var data = {'_token':token,'pid':pid}
        $.post(url,data,function(response){
            $('#node_box').html(response);
        });
    }
</script>
</body>

</html>

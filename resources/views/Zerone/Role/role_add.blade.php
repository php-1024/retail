<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技管理平台</title>

    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>添加权限角色</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="JavaScript:;">下级人员</a>
                    </li>
                    <li class="active">
                        <strong>添加权限角色</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>添加权限角色</h5>

                        </div>
                        <div class="ibox-content">
                            <p>
                                权限角色主要用于区分用户职责以及为用户快速分配权限
                            </p>
                            <div class="hr-line-dashed"></div>
                            <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('zerone/ajax/role_add_check') }}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">角色名称</label>
                                    <div class="col-sm-10"><input type="text" name="role_name" class="form-control"></div>

                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" >角色权限</label>
                                    <div class="col-sm-10">
                                        @foreach($module_node_list as $key=>$val)
                                            <group class="checked_box_group_{{ $val['id'] }}">
                                                <div>
                                                    <label class="i-checks">
                                                        <input type="checkbox" class="checkbox_module_name checkbox_module_name_{{ $val['id'] }}" value="{{ $val['id'] }}">
                                                    </label>
                                                </div>
                                                <div>
                                                    @foreach($val['program_nodes'] as $kk=>$vv)
                                                        <label class="checkbox-inline i-checks" style="margin-left: 0px;margin-right:10px; margin-bottom: 10px;">
                                                            <input type="checkbox"  data-group_id="{{  $val['id'] }}" class="checkbox_node_name checkbox_node_name_{{ $val['id'] }}" name="module_node_ids[]" value="{{ $vv['id'] }}"> {{ $vv['node_show_name'] }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </group>
                                            <div class="hr-line-dashed" style="clear: both;"></div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">安全密码</label>
                                    <div class="col-sm-10"><input type="password" name="safe_password" class="form-control"></div>

                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-5">
                                        <button class="btn btn-primary" id="addbtn" onclick="return postForm();" type="button">确认添加</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('Zerone/Public/Footer')
    </div>
</div>
    <!-- Mainly scripts -->
    <script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
    <script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>
    <script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
    <script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('.checkbox_module_name').on('ifChecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
                var id = $(this).val();
                $('.checkbox_node_name_'+id).iCheck('check') ;
            }).on('ifUnchecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
                var id = $(this).val();
                $('.checkbox_node_name_'+id).iCheck('uncheck') ;
            });
            $('.checkbox_node_name').on('ifUnchecked',function(event){
                var group_id = $(this).attr('data-group_id');
                var tag=false;
                $('.checkbox_node_name_'+group_id).each(function(i,v){
                    if($('.checkbox_node_name_'+group_id+':eq('+i+')').is(":checked")){
                        tag=true;
                    }
                });
                if(tag==false){
                    $('.checkbox_module_name_'+group_id).iCheck('uncheck') ;
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
    </script>
</body>

</html>

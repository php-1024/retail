<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">

    <link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>管理首页</h2>
                <ol class="breadcrumb">
                    <li> <a href="JavaScript:;">控制面板</a> </li>
                    <li class="active"> <strong>个人信息</strong> </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>个人信息详情</h5>
                        </div>
                        <div>
                            <div class="ibox-content">
                                <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('zerone/ajax/personal_edit_check') }}">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">用户账号</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly value="{{$user['account']}}">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">系统角色</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly value="{{$admin_data['role_name']}}">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">真实姓名</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="realname" class="form-control" value="{{$user['account_info']['realname']}}">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">手机号码</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mobile" class="form-control" value="{{$user['mobile']}}">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">安全密码</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="safe_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group ">
                                        <div class="col-sm-12 col-sm-offset-5">
                                            <button class="btn btn-primary" id="addbtn" onclick="return postForm();" type="button">确认修改</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>我的权限</h5>
                        </div>
                        <div class="ibox-content">
                            @foreach($module_node_list as $key=>$val)
                                <group class="checked_box_group_{{ $val['id'] }}">
                                    <div>
                                        <label class="i-checks">
                                            <input type="checkbox" class="checkbox_module_name checkbox_module_name_{{ $val['id'] }}"  disabled="true" checked="checked"  value="{{ $val['id'] }}"> {{ $val['module_show_name'] }}
                                        </label>
                                    </div>
                                    <div>
                                        @foreach($val['program_nodes'] as $kk=>$vv)
                                            <label class="checkbox-inline i-checks" style="margin-left:0px; margin-right:10px; margin-bottom: 10px;">
                                                <input type="checkbox"  data-group_id="{{ $val['id'] }}" disabled="true" checked="checked"  class="checkbox_node_name checkbox_node_name_{{ $val['id'] }}" name="module_node_ids[]" value="{{ $vv['id'] }}"> {{ $vv['node_show_name'] }}
                                            </label>
                                        @endforeach
                                    </div>
                                </group>
                                <div class="hr-line-dashed" style="clear: both;"></div>
                            @endforeach
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
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
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

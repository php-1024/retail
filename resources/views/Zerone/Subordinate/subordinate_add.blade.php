<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技管理平台</title>

    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/wizard')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>添加下级人员</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="JavaScript:;">下级人员</a>
                    </li>
                    <li class="active">
                        <strong>添加下级人员</strong>
                    </li>
                </ol>
            </div>

        </div>
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>添加下级人员</h5>

                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('zerone/ajax/subordinate_add_check') }}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <input type="hidden" id="quick_rule_url" value="{{ url('zerone/ajax/quick_rule') }}">
                                <div id="rootwizard">
                                    <ul>
                                        <li><a href="#tab1" data-toggle="tab"><span class="label">1</span> 填写用户基础资料</a></li>
                                        <li><a href="#tab2" data-toggle="tab"><span class="label">2</span> 指派权限给用户</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1">
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">手机号码</label>
                                                <div class="col-sm-10"><input type="text" name="mobile" class="form-control"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">用户登录密码</label>
                                                <div class="col-sm-10"><input type="password" name="password" class="form-control"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">重复登录密码</label>
                                                <div class="col-sm-10"><input type="password" name="repassword" class="form-control"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">真实姓名</label>
                                                <div class="col-sm-10"><input type="text" name="realname" class="form-control"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">权限角色</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control m-b" name="role_id" id="role_id">
                                                        <option value="0">请选择</option>
                                                        @foreach($role_list as $k=>$v)
                                                            <option value="{{ $v->id }}">{{ $v->role_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2"><button type="button" class="btn btn-primary" onclick="get_quick_rule('#role_id');"><i class="fa fa-arrow-circle-down"></i>&nbsp;&nbsp;快速授权</button></div>
                                            </div>
                                            <div class="form-group" id="module_node_box"></div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">安全密码</label>
                                                <div class="col-sm-10"><input type="password" name="safe_password" class="form-control"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                        <ul class="pager wizard">

                                            <li class="previous"><button type="button" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;上一步</button></li>

                                            <li class="next"><button type="button" class="btn btn-primary">下一步&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></button></li>
                                            <li class="finish"><button type="button" id="addbtn" class="btn btn-primary" onclick="return postForm();">完成&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></button></li>
                                        </ul>
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
    <script src="{{asset('public/Zerone/library/wizard')}}/js/jquery.bootstrap.wizard.min.js"></script>
    <script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
            get_quick_rule('#role_id');
        });
        //获取上级程序节点
        function get_quick_rule(obj){
            var url =  $('#quick_rule_url').val();
            var token = $('#_token').val();
            var role_id = $(obj).val();
            var data = {'_token':token,'role_id':role_id}
            $.post(url,data,function(response){
                $('#module_node_box').html(response);
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

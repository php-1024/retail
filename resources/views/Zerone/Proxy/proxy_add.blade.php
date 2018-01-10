<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>
    <link href="{{asset('public/Zerone')}}/css/bootstrap.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{asset('public/Zerone')}}/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/plugins/switchery/switchery.css" rel="stylesheet">


</head>

<body class="">


<div id="wrapper">
        @include('Zerone/Public/Nav')

        <div id="page-wrapper" class="gray-bg">
            @include('Zerone/Public/Header')

            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>添加服务商</h5>

                            </div>
                            <div class="ibox-content">
                                <form method="get" id="proxyForm" class="form-horizontal" action="{{url('zerone/ajax/proxy_add_check')}}">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <div class="form-group"><label class="col-sm-2 control-label">所在战区</label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="zone_id">
                                                @foreach($warzone_list as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->zone_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">服务商名称</label>
                                        <div class="col-sm-10"><input type="text" name="proxy_name" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">负责人姓名</label>
                                        <div class="col-sm-10"><input type="text" name="proxy_owner" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">负责人身份证号</label>
                                        <div class="col-sm-10"><input type="text" name="proxy_owner_idcard" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">手机号码</label>
                                        <div class="col-sm-10"><input type="text" name="proxy_owner_mobile" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">服务商登陆密码</label>
                                        <div class="col-sm-10"><input type="text" name="proxy_password" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">重复登陆密码</label>
                                        <div class="col-sm-10"><input type="text" name="re_proxy_password" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">安全密码</label>
                                        <div class="col-sm-10"><input type="text" name="safe_password" class="form-control"></div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group ">
                                        <div class="col-sm-4 col-sm-offset-5">
                                            <button class="btn btn-primary" id="addbtn" onclick="return postForm();" type="button">确认申请</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer" >
                <div class="pull-right">
                    您登陆的时间是：2017-10-24 16:26:30
                </div>
                <div>
                    <strong>Copyright</strong> 零壹新科技（深圳有限公司）&copy; 2017-2027
                </div>
            </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="{{asset('public/Zerone')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone')}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone')}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone')}}/js/plugins/pace/pace.min.js"></script>
<!-- Sweet alert -->
<script src="{{asset('public/Zerone')}}/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('public/Zerone')}}/js/plugins/iCheck/icheck.min.js"></script>
<script src="{{asset('public/Zerone')}}/js/plugins/switchery/switchery.js"></script>cript>
<!-- Page-Level Scripts -->
<script>
//    $(document).ready(function() {
//        $('#addbtn').click(function(){
//            swal({
//                title: "温馨提示",
//                text: "修改成功",
//                type: "success"
//            });
//        });
//        var elem = document.querySelector('.js-switch');
//        var switchery = new Switchery(elem, { color: '#1AB394' });
//        $('.i-checks').iCheck({
//            checkboxClass: 'icheckbox_square-green',
//            radioClass: 'iradio_square-green',
//        });
//    });


    $(function(){
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
</script>
</body>

</html>

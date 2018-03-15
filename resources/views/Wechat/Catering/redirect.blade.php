<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/bootstrap.css" type="text/css" />
    <link href="{{asset('public/Catering')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <input type="hidden" id="id" value="{{ $id }}">
    <input type="hidden" id="organization_id" value="{{ $organization_id }}">
    <input type="hidden" id="redirect_url" value="{{ url($redirect_url) }}">
    <input type="hidden" id="get_authorizer_info_url" value="{{ url('api/wechat/pull_authorizer_data') }}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
</section>
<script src="{{asset('public/Catering')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Catering')}}/js/bootstrap.js"></script>

<script type="text/javascript" src="{{asset('public/Catering')}}/sweetalert/sweetalert.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: "提示信息",
            text: '正在对接公众号数据，请稍后且勿关闭页面...',
            confirmButtonColor:"#DD6B55",
            confirmButtonText: "确定",
            type: "warning"
        });//弹出窗口

        $('button.confirm').hide();//隐藏弹窗按钮

        var url = $('#get_authorizer_info_url').val();
        var organization_id = $('#organization_id').val();
        var redirect_url = $('#redirect_url').val();
        var id = $('#id').val();
        var token = $('#_token').val();
        $.post(url,{'organization_id':organization_id,'_token':token,'id':id},function(data){
            if(data.status=='1'){
                window.location.href = redirect_url;
            }
        })
    });
</script>
</body>
</html>
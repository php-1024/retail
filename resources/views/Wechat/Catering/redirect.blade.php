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
    <input type="hidden" name="organization_id" value="{{ $organization_id }}">
    <input type="hidden" name="redirect_url" value="{{ url($redirect_url) }}">
</section>
<script src="{{asset('public/Catering')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Catering')}}/js/bootstrap.js"></script>

<script type="text/javascript" src="{{asset('public/Catering')}}/sweetalert/sweetalert.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "提示信息",
            text: '正在对接公众号数据，请稍后且勿关闭页面...',
            confirmButtonColor:"#DD6B55",
            confirmButtonText: "确定",
            type: "warning"
        });//弹出窗口

        $('button.confirm').hide();//隐藏弹窗按钮


    });
</script>
</body>
</html>
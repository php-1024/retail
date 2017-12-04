<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Program/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Program/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <link href="{{asset('public/Program/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/Program')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Program')}}/css/style.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Program/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Program/Public/Header')

        @include('Program/Public/Footer')
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/Program/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Program/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Program/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Program/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Program')}}/js/inspinia.js"></script>
<script src="{{asset('public/Program/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Program/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Program/library/multiselect')}}/js/multiselect.js"></script>

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
        var _token = $('#_token').val();
        var node = '';

        $('#multiselect_to option').each(function(i,v){
            node += 'nodes[]='+$(v).val()+'&';
        });
        node = node.substring(0, node.length-1);
        var data = '_token='+_token+'&module_name='+module_name+'&'+node;
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

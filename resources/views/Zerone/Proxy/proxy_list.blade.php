<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>
    <link href="{{asset('public/Zerone')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/plugins/footable/footable.core.css" rel="stylesheet">
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
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>服务商列表</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">服务商管理</a>
                    </li>
                    <li >
                        <strong>服务商列表</strong>
                    </li>
                </ol>
            </div>

        </div>


    </div>
    <!-- Mainly scripts -->
    <script src="{{asset('public/Zerone/library/pace')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('public/Zerone/library/pace')}}/js/inspinia.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/pace/pace.min.js"></script>
    <!-- Data picker -->
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <!-- Sweet alert -->
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- FooTable -->
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/footable/footable.all.min.js"></script>

    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/plugins/switchery/switchery.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('.footable').footable();

            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            $("#editBtn").click(function(){
                $('#myModal').modal();
            });
            $('#lockBtn').click(function(){
                $('#myModal3').modal();
            });
            $('#removeBtn').click(function(){
                $('#myModal3').modal();
            });
            $('.saveBtn').click(function(){
                swal({
                    title: "温馨提示",
                    text: "操作成功",
                    type: "success"
                },function(){
                    window.location.reload();
                });
            });
        });
    </script>
</div>
</body>

</html>

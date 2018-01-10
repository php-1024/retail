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
    <script src="{{asset('public/Zerone')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/Zerone')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/Zerone')}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{asset('public/Zerone')}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
    <script src="{{asset('public/Zerone')}}/js/plugins/pace/pace.min.js"></script>
    <!-- Data picker -->
    <script src="{{asset('public/Zerone')}}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <!-- Sweet alert -->
    <script src="{{asset('public/Zerone')}}/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- FooTable -->
    <script src="{{asset('public/Zerone')}}/js/plugins/footable/footable.all.min.js"></script>

    <script src="{{asset('public/Zerone')}}/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{asset('public/Zerone')}}/js/plugins/switchery/switchery.js"></script>
    <!-- Page-Level Scripts -->
</div>
</body>

</html>

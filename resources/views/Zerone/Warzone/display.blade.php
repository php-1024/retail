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
    <!-- Sweet Alert -->
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/switchery')}}/css/switchery.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')
    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>战区管理</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">系统管理</a>
                    </li>
                    <li >
                        <strong>战区管理</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">


            <div class="ibox-content m-b-sm border-bottom">

                <div class="row">
                    <div class="pull-left padding_l_r_15">
                        <div class="form-group">
                            <label class="control-label" for="amount">&nbsp;</label>
                            <button type="button" class="block btn-w-m btn btn-primary" id="addBtn"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加战区</button>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="amount">战区名称</label>
                            <input type="text" id="amount" name="amount" value="" placeholder="Amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" class="block btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">

                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>战区名称</th>
                                    <th>战区覆盖范围</th>
                                    <th>服务商数量</th>
                                    <th class="text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        东北战区
                                    </td>
                                    <td>
                                        <label class="label label-success" style="display:inline-block">广东省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖北省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河北省</label>&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        23位服务商
                                    </td>
                                    <td class="text-right">
                                        <button type="button" id="editBtn"  class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" id="deleteBtn" class="btn  btn-xs btn-warning"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        <button type="button" id="deleteBtn2" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;彻底删除</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        2
                                    </td>
                                    <td>
                                        东南战区
                                    </td>
                                    <td>
                                        <label class="label label-success" style="display:inline-block">广东省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖北省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河北省</label>&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        46位服务商
                                    </td>

                                    <td class="text-right">
                                        <button type="button" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" class="btn  btn-xs btn-warning"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        <button type="button" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;彻底删除</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        3
                                    </td>
                                    <td>
                                        西北战区
                                    </td>
                                    <td>
                                        <label class="label label-success" style="display:inline-block">广东省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖北省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河北省</label>&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        58位服务商
                                    </td>

                                    <td class="text-right">
                                        <button type="button" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" class="btn  btn-xs btn-warning"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        <button type="button" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;彻底删除</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        4
                                    </td>
                                    <td>
                                        西南战区
                                    </td>
                                    <td>
                                        <label class="label label-success" style="display:inline-block">广东省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖北省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河北省</label>&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        66位服务商
                                    </td>

                                    <td class="text-right">
                                        <button type="button" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" class="btn  btn-xs btn-warning"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        <button type="button" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;彻底删除</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        4
                                    </td>
                                    <td>
                                        中南战区
                                    </td>
                                    <td>
                                        <label class="label label-success" style="display:inline-block">广东省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">湖北省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河南省</label>&nbsp;&nbsp;
                                        <label class="label label-success" style="display:inline-block">河北省</label>&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        83位服务商
                                    </td>

                                    <td class="text-right">
                                        <button type="button" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" class="btn  btn-xs btn-warning"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        <button type="button" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;彻底删除</button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="99" class="footable-visible">
                                        <ul class="pagination pull-right">
                                            <li class="footable-page-arrow disabled">
                                                <a data-page="first" href="#first">«</a>
                                            </li>

                                            <li class="footable-page-arrow disabled">
                                                <a data-page="prev" href="#prev">‹</a>
                                            </li>
                                            <li class="footable-page active">
                                                <a data-page="0" href="#">1</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">2</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">3</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">4</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">5</a>
                                            </li>
                                            <li class="footable-page-arrow">
                                                <a data-page="next" href="#next">›</a>
                                            </li>
                                            <li class="footable-page-arrow">
                                                <a data-page="last" href="#last">»</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

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
    <!-- Sweet alert -->
    <script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
    <script src="{{asset('public/Zerone/library/datepicker')}}/js/bootstrap-datepicker.js"></script>
    <script src="{{asset('public/Zerone/library/footable')}}/js/footable.all.min.js"></script>
    <script src="{{asset('public/Zerone/library/chosen')}}/js/chosen.jquery.js"></script>
    <!-- Page-Level Scripts -->


    <script>
        $(document).ready(function() {

            $('.chosen-select2').chosen({width:"100%"});
            $('.chosen-select').chosen({width:"100%"});
            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('.gg').chosen();
            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            $('#deleteBtn').click(function(){
                swal({
                    title: "温馨提示",
                    text: "删除成功",
                    type: "success"
                });
            });
            $('#deleteBtn2').click(function(){
                swal({
                    title: "温馨提示",
                    text: "删除失败,您没有操作权限",
                    type: "error"
                });
            });
            $('#addBtn').click(function(){
                $('#myModal').modal();
            });
            $('#editBtn').click(function(){
                $('#myModal2').modal();
            });

        });
    </script>

</body>

</html>

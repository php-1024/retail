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
            <div class="wrapper wrapper-content animated fadeInRight ecommerce">


                <div class="ibox-content m-b-sm border-bottom">

                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount">服务商名称</label>
                                <input type="text" id="amount" name="amount" value="" placeholder="请输入服务商名称" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount">手机号码</label>
                                <input type="text" id="amount" name="amount" value="" placeholder="手机号码" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount">所在战区</label>
                                <select class="form-control m-b" name="account">
                                    <option>东部战区</option>
                                    <option>西部战区</option>
                                    <option>南部战区</option>
                                    <option>北部战区</option>
                                    <option>中部战区</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount"> &nbsp;</label>
                                <button type="button" class="block btn btn-info"><i class="fa fa-search"></i>搜索</button>
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
                                        <th>服务商名称</th>
                                        <th>所在战区</th>
                                        <th>负责人姓名</th>

                                        <th>手机号码</th>
                                        <th>服务商状态</th>
                                        <th class="col-sm-1">注册时间</th>
                                        <th class="col-sm-4 text-right" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>刘记新科技有限公司</td>
                                        <td>南部战区</td>
                                        <td>刘兴文</td>


                                        <td>13123456789</td>
                                        <td>
                                            <label class="label label-primary">正常</label>
                                        </td>
                                        <td>2017-08-08 10:30:30</td>
                                        <td class="text-right">
                                            <button type="button" id="editBtn" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" id="lockBtn" class="btn  btn-xs btn-warning"><i class="fa fa-lock"></i>&nbsp;&nbsp;冻结</button>
                                            <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                            <button type="button" id="peoplesBtn" onclick="location.href='proxystructure.html'" class="btn btn-outline btn-xs btn-primary"><i class="fa fa-users"></i>&nbsp;&nbsp;人员架构</button>
                                            <button type="button" id="programBtn" onclick="location.href='proxyprogram.html'" class="btn btn-outline btn-xs btn-warning"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;程序管理</button>
                                            <button type="button" id="companyBtn" onclick="location.href='proxycompany.html'" class="btn btn-outline btn-xs btn-danger"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;商户划拨管理</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>刘记新科技有限公司</td>
                                        <td>东部战区</td>
                                        <td>刘兴文</td>

                                        <td>13123456789</td>
                                        <td>
                                            <label class="label label-primary">正常</label>
                                        </td>
                                        <td>2017-08-08 10:30:30</td>
                                        <td class="text-right">
                                            <button type="button" id="editBtn" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" id="unlockBtn" class="btn  btn-xs btn-info"><i class="fa fa-unlock"></i>&nbsp;&nbsp;解冻</button>
                                            <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                            <button type="button" id="peoplesBtn" class="btn btn-outline btn-xs btn-primary"><i class="fa fa-users"></i>&nbsp;&nbsp;人员架构</button>
                                            <button type="button" id="programBtn" class="btn btn-outline btn-xs btn-warning"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;程序管理</button>
                                            <button type="button" id="companyBtn" class="btn btn-outline btn-xs btn-danger"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;商户划拨管理</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>刘记新科技有限公司</td>
                                        <td>西部战区</td>
                                        <td>刘兴文</td>

                                        <td>13123456789</td>
                                        <td>
                                            <label class="label label-danger">已冻结</label>
                                        </td>
                                        <td>2017-08-08 10:30:30</td>
                                        <td class="text-right">
                                            <button type="button" id="editBtn" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" id="lockBtn" class="btn  btn-xs btn-warning"><i class="fa fa-lock"></i>&nbsp;&nbsp;冻结</button>
                                            <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                            <button type="button" id="peoplesBtn" class="btn btn-outline btn-xs btn-primary"><i class="fa fa-users"></i>&nbsp;&nbsp;人员架构</button>
                                            <button type="button" id="programBtn" class="btn btn-outline btn-xs btn-warning"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;程序管理</button>
                                            <button type="button" id="companyBtn" class="btn btn-outline btn-xs btn-danger"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;商户划拨管理</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="9" class="footable-visible">
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

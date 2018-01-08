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
</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>添加权限角色</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="JavaScript:;">下级人员</a>
                    </li>
                    <li class="active">
                        <strong>添加权限角色</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>添加权限角色</h5>

                        </div>
                        <div class="ibox-content">
                            <p>
                                权限角色主要用于区分用户职责以及为用户快速分配权限
                            </p>
                            <div class="hr-line-dashed"></div>
                            <form method="get" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">角色名称</label>
                                    <div class="col-sm-10"><input type="text" class="form-control"></div>

                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">角色权限</label>
                                    <div class="col-sm-10">
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单编辑
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2"> 订单查询
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单添加
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单删除
                                            </label>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单编辑
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2"> 订单查询
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单添加
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单删除
                                            </label>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单编辑
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2"> 订单查询
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单添加
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单删除
                                            </label>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单模块
                                            </label>
                                        </div>
                                        <div>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option1" id="inlineCheckbox1"> 订单编辑
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option2" id="inlineCheckbox2"> 订单查询
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单添加
                                            </label>

                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" value="option3" id="inlineCheckbox3"> 订单删除
                                            </label>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-5">
                                        <button class="btn btn-primary" id="addbtn" type="button">确认添加</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('Tooling/Public/Footer')
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
    <script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
    <script>

    </script>
</body>

</html>

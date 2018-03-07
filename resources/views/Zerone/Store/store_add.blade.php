<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>
    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/chosen')}}/css/chosen.css" rel="stylesheet">
</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>添加店铺</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">店铺管理</a>
                    </li>
                    <li >
                        <strong>添加店铺</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>添加店铺</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>序</th>
                                    <th>程序名称</th>
                                    <th>程序模块</th>
                                    <th class="col-sm-2 text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>微餐饮系统（先吃后付）通用版本</td>
                                    <td>
                                        <label class="label label-primary" data-container="body" data-toggle="popover" data-placement="top" data-content="订单查询，订单编辑，订单添加，订单删除" style="display:inline-block">订单模块</label>&nbsp;&nbsp;
                                    </td>
                                    <td class="text-right">
                                        <button type="button" id="addbtn" class="btn  btn-xs btn-danger"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;开设店铺</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Zerone/Public/Footer')
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h3>添加店铺</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">程序名称</label>
                            <div class="col-sm-9"><input type="text" readonly class="form-control" value="微餐饮系统（先吃后付）通用版本"></div>
                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="padding-top: 7px;">商户名称</label>
                            <div class="col-sm-9">
                                <select data-placeholder="请选择省份" class="chosen-select" style="width:350px;" tabindex="4">
                                    <option value="Mayotte">公司总部</option>
                                    <option value="Mayotte">刘记集团</option>
                                    <option value="Mexico">李记鸡煲连锁</option>
                                    <option value="Micronesia, Federated States of">叶记猪肚鸡</option>
                                    <option value="Moldova, Republic of">韦记莲藕汤</option>
                                </select>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">店铺名称</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">允许开设分店数量</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="padding-top: 7px;">消耗程序与分店数量</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" class="js-switch" checked  value="1"/>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">负责人姓名</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div> -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">店铺管理账号</label>
                                <div class="col-sm-9"><input type="text" readonly class="form-control" value="1321321321"></div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">店铺登录密码</label>
                                <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">重复登录密码</label>
                                <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">安全密码</label>
                                <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary saveBtn">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<!-- Page-Level Scripts -->--}}
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>

<!-- Sweet alert -->
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>
<script src="{{asset('public/Tooling/library/chosen')}}/js/chosen.jquery.js"></script>

<script>
    $(document).ready(function() {
        $('.chosen-select').chosen({width:"100%",no_results_text:'对不起，没有找到结果！关键词：'});
        $('#addbtn').click(function(){
            $('#myModal').modal();
        });
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

</body>

</html>

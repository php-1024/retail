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
    <link href="{{asset('public/Zerone/library/chosen')}}/css/chosen.css" rel="stylesheet">
    <script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
    <script src="{{asset('public/Zerone/library/switchery')}}/js/switchery.js"></script>
</head>

<body class="">


<div id="wrapper">
    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>“刘记餐饮集团”店铺管理</h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href="JavaScript:;">商户管理</a>
                        </li>
                        <li >
                            <strong>“刘记餐饮集团”店铺管理</strong>
                        </li>
                    </ol>
                </div>

            </div>

            <div class="wrapper wrapper-content animated fadeInRight ecommerce">


                <div class="ibox-content m-b-sm border-bottom">

                    <div class="row">
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label class="control-label" for="amount"> &nbsp;</label>
                                <button type="button" onclick="location.href='fansmanagelist.html'" class="block btn btn-info"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label class="control-label" for="amount"> &nbsp;</label>
                                <button type="button" id="addBtn" class="block btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;店铺划入归属</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>“刘记餐饮集团”店铺管理</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
                                        <th>序</th>
                                        <th>店铺名称</th>
                                        <th>店铺类型</th>
                                        <th>归属总店</th>
                                        <th>使用系统程序</th>


                                        <th class="col-sm-2 text-right" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>刘记鸡煲王总店</td>
                                        <td>
                                            <label class="label label-success" style="display:inline-block">总店</label>
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>微餐饮系统（先吃后付）通用版本</td>
                                        <td class="text-right">
                                            <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;店铺划出</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>刘记鸡煲王宝能店</td>
                                        <td>
                                            <label class="label label-primary" style="display:inline-block">分店</label>
                                        </td>
                                        <td>
                                            刘记鸡煲王总店
                                        </td>
                                        <td>微餐饮系统（先吃后付）通用版本</td>
                                        <td class="text-right">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>刘记鸡煲王龙城店</td>
                                        <td>
                                            <label class="label label-primary" style="display:inline-block">分店</label>
                                        </td>
                                        <td>
                                            刘记鸡煲王总店
                                        </td>
                                        <td>微餐饮系统（先吃后付）通用版本</td>
                                        <td class="text-right">
                                            -
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>刘记猪肚鸡总店</td>
                                        <td>
                                            <label class="label label-success" style="display:inline-block">总店</label>
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>微餐饮系统（自选店模式）通用版本</td>
                                        <td class="text-right">
                                            <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;店铺划出</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>刘记猪肚鸡宝能店</td>
                                        <td>
                                            <label class="label label-primary" style="display:inline-block">分店</label>
                                        </td>
                                        <td>
                                            刘记猪肚鸡总店
                                        </td>
                                        <td>微餐饮系统（自选店模式）通用版本</td>
                                        <td class="text-right">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>刘记猪肚鸡龙城店</td>
                                        <td>
                                            <label class="label label-primary" style="display:inline-block">分店</label>
                                        </td>
                                        <td>
                                            刘记猪肚鸡总店
                                        </td>
                                        <td>微餐饮系统（自选店模式）通用版本</td>
                                        <td class="text-right">
                                            -
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
        @include('Zerone/Public/Footer')
        </div>

        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h3>“刘记餐饮集团”店铺划入</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="padding-top: 7px;">请选择要划入的店铺</label>
                            <div class="col-sm-9">
                                <select data-placeholder="请选择省份" class="chosen-select" style="width:350px;" tabindex="4">
                                    <option value="Mayotte">刘记鸡煲王</option>
                                    <option value="Mexico">李记鸡煲王</option>
                                    <option value="Micronesia, Federated States of">叶记猪肚鸡</option>
                                    <option value="Moldova, Republic of">韦记莲藕汤</option>
                                </select>
                            </div>

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

                        <div class="form-group">
                            <label class="col-sm-3 control-label">安全密码</label>
                            <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
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

            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <h3>“刘记餐饮集团”店铺划出</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">划出店铺</label>
                                <div class="col-sm-9"><input type="text" class="form-control" value="刘记鸡煲王" readonly></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="padding-top: 7px;">划给商户</label>
                                <div class="col-sm-9">
                                    <select data-placeholder="请选择省份" class="chosen-select" style="width:350px;" tabindex="4">
                                        <option value="Mayotte">公司总部</option>
                                        <option value="Mayotte">刘记集团</option>
                                        <option value="Mexico">李记鸡煲连锁</option>
                                        <option value="Micronesia, Federated States of">叶记猪肚鸡</option>
                                        <option value="Moldova, Republic of">韦记莲藕汤</option>
                                    </select>
                                </div>

                            </div>

                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="padding-top: 7px;">归还程序与分店数量</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" class="js-switch2" checked  value="1"/>
                                </div>

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
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Zerone/library/chosen')}}/js/chosen.jquery.js"></script>
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {
        $('.chosen-select').chosen({width:"100%",no_results_text:'对不起，没有找到结果！关键词：'});
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        var elem = document.querySelector('.js-switch2');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        // activate Nestable for list 2
        $('#addBtn').click(function(){
            $('#myModal2').modal();
        });

        $('#removeBtn').click(function(){
            $('#myModal').modal();
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

</body>

</html>

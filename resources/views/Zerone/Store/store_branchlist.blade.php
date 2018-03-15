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
                <h2>“刘记鸡煲王（总店）”分店管理</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">商户管理</a>
                    </li>
                    <li >
                        <strong>“刘记鸡煲王（总店）”分店管理</strong>
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
                            <button type="button" onclick="history.back()" class="block btn btn-info"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" id="addBtn" class="block btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加分店</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>“刘记鸡煲王（总店）”分店管理</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>分店名称</th>
                                    <th>分店系统</th>
                                    <th>归属店铺</th>
                                    <th>负责人姓名</th>
                                    <th>手机号码</th>
                                    <th>负责人账号</th>
                                    <th>商户状态</th>
                                    <th class="col-sm-1">新增时间</th>
                                    <th class="col-sm-3 text-right" >操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>刘记鸡煲王（宝能店）</td>
                                    <td>微餐饮系统（先吃后付）通用版本</td>
                                    <td>刘记鸡煲王（总店）</td>
                                    <td>刘兴文</td>
                                    <td>13123456789</td>
                                    <td>zob_13123456789</td>
                                    <td>
                                        <label class="label label-primary">正常</label>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button type="button" id="editBtn" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" id="lockBtn" class="btn  btn-xs btn-warning"><i class="fa fa-lock"></i>&nbsp;&nbsp;冻结</button>
                                        <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
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


        <div class="footer" >
            <div class="pull-right">
                您登录的时间是：2017-10-24 16:26:30
            </div>
            <div>
                <strong>Copyright</strong> 零壹新科技（深圳有限公司）&copy; 2017-2027
            </div>
        </div>

    </div>


    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <h3>添加分店</h3>
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
                        <div class="col-sm-9"><input type="text" readonly class="form-control" value="刘记鸡煲王"></div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="padding-top: 7px;">总店名称</label>
                        <div class="col-sm-9"><input type="text" readonly class="form-control" value="刘记鸡煲王（总店）"></div>
                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">分店名称</label>
                        <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">负责人姓名</label>
                        <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">负责人手机号</label>
                        <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">分店登录密码</label>
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
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h3>修改分店</h3>
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
                            <div class="col-sm-9"><input type="text" readonly class="form-control" value="刘记鸡煲王"></div>
                        </div>
                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="padding-top: 7px;">总店名称</label>
                            <div class="col-sm-9"><input type="text" readonly class="form-control" value="刘记鸡煲王（总店）"></div>
                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">分店名称</label>
                            <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">负责人姓名</label>
                            <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">负责人手机号</label>
                            <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">分店登录密码</label>
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
            <div class="modal inmodal" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <h3>确认操作</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">安全密码</label>
                                <div class="col-sm-10"><input type="password" class="form-control" value=""></div>
                            </div>
                            <div style="clear:both"></div>

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
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>
<script src="{{asset('public/Tooling/library/chosen')}}/js/chosen.jquery.js"></script>
<script>
    $(document).ready(function() {
        $('.chosen-select').chosen({width:"100%",no_results_text:'对不起，没有找到结果！关键词：'});
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        var elem = document.querySelector('.js-switch2');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        // activate Nestable for list 2
        $('#addBtn').click(function(){
            $('#myModal').modal();
        });

        $("#editBtn").click(function(){
            $('#myModal2').modal();
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

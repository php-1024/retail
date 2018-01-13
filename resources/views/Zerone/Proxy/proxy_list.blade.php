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
                <div class="footer" >
                    <div class="pull-right">
                        您登陆的时间是：2017-10-24 16:26:30
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
                            <h3>编辑服务商</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">所在战区</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="account">
                                        <option>东部战区</option>
                                        <option>西部战区</option>
                                        <option>南部战区</option>
                                        <option>北部战区</option>
                                        <option>中部战区</option>
                                    </select>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">服务商名称</label>
                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">负责人姓名</label>
                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">负责人身份证号</label>
                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">手机号码</label>
                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">服务商登陆密码</label>
                                <div class="col-sm-10"><input type="text" class="form-control"></div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">安全密码</label>
                                <div class="col-sm-10"><input type="text" class="form-control" value=""></div>
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
        <div class="modal inmodal" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h3>确认操作</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">安全密码</label>
                            <div class="col-sm-10"><input type="text" class="form-control" value=""></div>
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

    {{--<!-- Page-Level Scripts -->--}}
    <script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
    <script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>
    <script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
    <script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>

    <script src="{{asset('public/Zerone')}}/js/switchery.js"></script>
    <script src="{{asset('public/Zerone')}}/js/footable.all.min.js"></script>
    <script src="{{asset('public/Zerone')}}/js/bootstrap-datepicker.js"></script>




    <!-- Data picker -->
    {{--<script src="{{asset('public/Zerone')}}/js/plugins/datapicker/bootstrap-datepicker.js"></script>--}}


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

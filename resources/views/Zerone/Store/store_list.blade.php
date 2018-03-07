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
                <h2>店铺列表</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">店铺管理</a>
                    </li>
                    <li >
                        <strong>店铺列表</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">


            <div class="ibox-content m-b-sm border-bottom">

                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="amount">店铺名称</label>
                            <input type="text" id="amount" name="amount" value="" placeholder="请输入店铺名称" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="amount">手机号码</label>
                            <input type="text" id="tell" name="tell" value="" placeholder="手机号码" class="form-control">
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
                                    <th>店铺名称</th>
                                    <th>店铺系统</th>
                                    <th>允许分店数</th>
                                    <th>归属商户</th>
                                    <th>店铺管理账号</th>
                                    <th>手机号码</th>
                                    <th>店铺状态</th>
                                    <th class="col-sm-1">新增时间</th>
                                    <th class="col-sm-4 text-right" >操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listStore as $key=>$value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->organization_name}}</td>
                                    <td>微餐饮系统（先吃后付）通用版本</td>
                                    <td>{{$branch_munber['aa23']}}</td>
                                    <td>刘记鸡煲王</td>
                                    <td>zos_13123456789</td>
                                    <td>13123456789</td>
                                    <td>
                                        <label class="label label-primary">正常</label>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button type="button" id="editBtn" class="btn  btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                        <button type="button" id="lockBtn" class="btn  btn-xs btn-warning"><i class="fa fa-lock"></i>&nbsp;&nbsp;冻结</button>
                                        <button type="button" id="removeBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        <button type="button" id="peoplesBtn" onclick="location.href='{{url('zerone/store/store_structure')}}'" class="btn btn-outline btn-xs btn-primary"><i class="fa fa-users"></i>&nbsp;&nbsp;人员架构</button>
                                        <button type="button" id="programBtn" onclick="location.href='{{url('zerone/store/store_branchlist')}}'" class="btn btn-outline btn-xs btn-warning"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;分店管理</button>
                                        <button type="button" id="companyBtn" onclick="location.href='{{url('zerone/store/store_config')}}'" class="btn btn-outline btn-xs btn-danger"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;参数设置</button>
                                    </td>
                                </tr>
                                @endforeach
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
                        <label class="col-sm-3 control-label">店铺管理账号</label>
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
                        <label class="col-sm-3 control-label">店铺登录密码</label>
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
{{--<!-- Page-Level Scripts -->--}}
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>

<!-- Data picker -->
<script src="{{asset('public/Zerone/library/datepicker')}}/js/bootstrap-datepicker.js"></script>

<!-- Sweet alert -->
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>

<!-- FooTable -->
<script src="{{asset('public/Zerone')}}/js/footable.all.min.js"></script>

<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>

<!-- Page-Level Scripts -->
<script src="{{asset('public/Tooling/library/chosen')}}/js/chosen.jquery.js"></script>

<script>
    $(document).ready(function() {
        $('.chosen-select').chosen({width:"100%",no_results_text:'对不起，没有找到结果！关键词：'});
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

</body>

</html>

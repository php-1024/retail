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
                <h2>“刘记餐饮集团”程序管理</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">商户管理</a>
                    </li>
                    <li >
                        <strong>“刘记餐饮集团”程序管理</strong>
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
                            <button type="button" onclick="location.href='{{url('zerone/company/company_list')}}'" class="block btn btn-info"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>“刘记餐饮集团”程序管理</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>套餐名称</th>
                                    <th>包含程序</th>
                                    <th>添加时间</th>
                                    <th class="text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>零壹科技餐饮系统</td>

                                    <td>
                                        <div>
                                            <span class="label label-danger"><i class="icon-code"></i> 零壹新科技餐饮总店系统</span> &nbsp;&nbsp;
                                            <span class="label label-primary">剩余：1 套</span>&nbsp;&nbsp;
                                            <span class="label label-warning">已用：1 套</span>&nbsp;&nbsp;
                                        </div>
                                        <div style=" margin-top: 30px;"></div>
                                        <div>
                                            <span class="label label-danger"><i class="icon-code"></i> 零壹新科技餐饮店铺系统</span> &nbsp;&nbsp;
                                            <span class="label label-primary">剩余：8 套</span>&nbsp;&nbsp;
                                            <span class="label label-warning">已用：7 套</span>&nbsp;&nbsp;
                                        </div>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button class="btn btn-info btn-xs" id="addBtn"><i class="icon-arrow-down"></i>&nbsp;&nbsp;程序划入</button>
                                        <button class="btn btn-primary btn-xs" id="minuBtn"><i class="icon-arrow-up"></i>&nbsp;&nbsp;程序划出</button>
                                    </td>
                                </tr>


                                <tr>
                                    <td>2</td>
                                    <td>零壹科技商超系统</td>

                                    <td>
                                        <div>
                                            <span class="label label-danger"><i class="icon-code"></i> 零壹新科技商超总店系统</span> &nbsp;&nbsp;
                                            <span class="label label-primary">剩余：0 套</span>&nbsp;&nbsp;
                                            <span class="label label-warning">已用：0 套</span>&nbsp;&nbsp;
                                        </div>
                                        <div style=" margin-top: 30px;"></div>
                                        <div>
                                            <span class="label label-danger"><i class="icon-code"></i> 零壹新科技商超店铺系统</span> &nbsp;&nbsp;
                                            <span class="label label-primary">剩余：0 套</span>&nbsp;&nbsp;
                                            <span class="label label-warning">已用：0 套</span>&nbsp;&nbsp;
                                        </div>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button class="btn btn-info btn-xs"><i class="icon-arrow-down"></i>&nbsp;&nbsp;程序划入</button>
                                        <button class="btn btn-primary btn-xs"><i class="icon-arrow-up"></i>&nbsp;&nbsp;程序划出</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>零壹科技酒店系统</td>

                                    <td>
                                        <div>
                                            <span class="label label-danger"><i class="icon-code"></i> 零壹新科技酒店系统</span> &nbsp;&nbsp;
                                            <span class="label label-primary">剩余：0 套</span>&nbsp;&nbsp;
                                            <span class="label label-warning">已用：0 套</span>&nbsp;&nbsp;
                                        </div>

                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button class="btn btn-info btn-xs"><i class="icon-arrow-down"></i>&nbsp;&nbsp;程序划入</button>
                                        <button class="btn btn-primary btn-xs"><i class="icon-arrow-up"></i>&nbsp;&nbsp;程序划出</button>
                                    </td>
                                </tr>
                                </tbody>

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
                    <h3>“刘记餐饮集团”程序划入</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label class="col-sm-4 control-label">微餐饮系统（先吃后付）通用版本</label>
                        <div class="col-sm-2">主程序：1套</div>
                        <div class="col-sm-2">分店数：5家</div>

                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="padding-top: 7px;">主程序划入</label>
                        <div class="col-sm-4" ><input type="text" class="form-control"></div>
                        <div class="col-sm-1" style="padding-top: 7px;">套</div>

                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="padding-top: 7px;">分店划入</label>
                        <div class="col-sm-4" ><input type="text" class="form-control"></div>
                        <div class="col-sm-1" style="padding-top: 7px;">家</div>

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

        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h3>“刘记餐饮集团”程序划出</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"><label class="col-sm-4 control-label">微餐饮系统（先吃后付）通用版本</label>
                            <div class="col-sm-2">主程序：188套</div>
                            <div class="col-sm-2">分店数：1880套</div>

                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="padding-top: 7px;">主程序划出</label>
                            <div class="col-sm-4" ><input type="text" class="form-control"></div>
                            <div class="col-sm-1" style="padding-top: 7px;">套</div>

                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="padding-top: 7px;">分店划出</label>
                            <div class="col-sm-4" ><input type="text" class="form-control"></div>
                            <div class="col-sm-1" style="padding-top: 7px;">家</div>

                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">安全密码</label>
                            <div class="col-sm-10"><input type="password" class="form-control" value=""></div>
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
<!-- Page-Level Scripts -->
<script>

    //owl carousel

    $(document).ready(function() {
        $('#addBtn').click(function(){
            $('#myModal').modal();
        });

        $('#minuBtn').click(function(){
            $('#myModal2').modal();
        });

    });

</script>

</body>

</html>

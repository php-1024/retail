<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/plugins/footable/footable.core.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{asset('public/Zerone/library/font')}}/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/plugins/switchery/switchery.css" rel="stylesheet">


</head>

<body class="">

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image"  src="img/zerone_logo.png" />
                         </span>
                    </div>
                    <div class="logo-element">
                        01
                    </div>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">系统管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="index.html">管理首页</a></li>
                        <li><a href="config.html">参数设置</a></li>
                        <li><a href="warzone.html">战区管理</a></li>
                        <li><a href="structure.html">人员结构</a></li>
                        <li><a href="alloperationlog.html">所有操作记录</a></li>
                        <li><a href="allloginlog.html">所有登陆记录</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"><i class="fa fa-user"></i> <span class="nav-label">个人中心</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="profile.html">个人资料</a></li>
                        <li><a href="editpassword.html">登陆密码修改</a></li>
                        <li><a href="safepassword.html">安全密码设置</a></li>
                        <li><a href="operationlog.html">我的操作日志</a></li>
                        <li><a href="loginlog.html">我的登录日志</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;"><i class="fa fa-sitemap"></i> <span class="nav-label">下级人员</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="addrole.html">添加权限角色</a></li>
                        <li><a href="rolelist.html">权限角色列表</a></li>
                        <li><a href="adduser.html">添加下级人员</a></li>
                        <li><a href="userlist.html">下级人员列表</a></li>
                        <li><a href="mystructure.html">下级人员结构</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="javascript:;"><i class="fa fa-globe"></i> <span class="nav-label">服务商管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="active"><a href="auditproxy.html">服务商注册审核</a></li>
                        <li><a href="addproxy.html">添加服务商</a></li>
                        <li><a href="proxylist.html">服务商列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-building"></i> <span class="nav-label">商户管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="auditcompany.html">商户注册审核</a></li>
                        <li><a href="addcompany.html">添加商户</a></li>
                        <li><a href="companylist.html">商户列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-cloud"></i> <span class="nav-label">店铺管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li><a href="addstore.html">添加店铺</a></li>
                        <li><a href="storelist.html">店铺列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="layouts.html"><i class="fa fa-sign-out"></i> <span class="nav-label">退出登录</span></a>
                </li>
            </ul>
        </div>
    </nav>


    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="javascript:;"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">欢迎登录！<strong>超级管理员-薛志豪</strong></span>
                </li>
                <li>
                    <a href="JavaScript:;">
                        <i class="fa fa-sign-out"></i>退出系统
                    </a>
                </li>
            </ul>
        </div>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>服务商注册审核</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">服务商管理</a>
                    </li>
                    <li >
                        <strong>服务商注册审核</strong>
                    </li>
                </ol>
            </div>

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
                                    <th>身份证号</th>
                                    <th>手机号码</th>
                                    <th>申请状态</th>
                                    <th class="col-sm-1">注册时间</th>
                                    <th class="col-sm-2 text-right" >操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>刘记新科技有限公司</td>
                                    <td>南部战区</td>
                                    <td>刘兴文</td>

                                    <td>440*** **** **** 2713</td>
                                    <td>13123456789</td>
                                    <td>
                                        <label class="label label-primary">已通过</label>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button type="button" id="okBtn" class="btn  btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;审核通过</button>
                                        <button type="button" id="notokBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;拒绝通过</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>刘记新科技有限公司</td>
                                    <td>东部战区</td>
                                    <td>刘兴文</td>
                                    <td>440*** **** **** 2713</td>
                                    <td>13123456789</td>
                                    <td>
                                        <label class="label label-warning">待审核</label>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button type="button" id="editBtn"  class="btn  btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;审核通过</button>
                                        <button type="button" id="deleteBtn" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;拒绝通过</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>刘记新科技有限公司</td>
                                    <td>西部战区</td>
                                    <td>刘兴文</td>
                                    <td>440*** **** **** 2713</td>
                                    <td>13123456789</td>
                                    <td>
                                        <label class="label label-danger">已拒绝</label>
                                    </td>
                                    <td>2017-08-08 10:30:30</td>
                                    <td class="text-right">
                                        <button type="button" id="deleteBtn" class="btn  btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;审核通过</button>
                                        <button type="button" id="deleteBtn2" class="btn  btn-xs btn-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;拒绝通过</button>
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

<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<script src="js/plugins/iCheck/icheck.min.js"></script>
<script src="js/plugins/switchery/switchery.js"></script>
<!-- Page-Level Scripts -->
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
        $('#notokBtn').click(function(){
            $('#myModal3').modal();
        });
        $('#okBtn').click(function(){
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

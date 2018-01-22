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
                                @foreach($list as $key=>$value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->package_name}}</td>

                                    <td>
                                        @foreach($value->programs as $k=>$v)
                                        <div>
                                            <span class="label label-danger"><i class="icon-code"></i> {{$v->program_name}}</span> &nbsp;&nbsp;
                                            <span class="label label-primary">剩余：1 套</span>&nbsp;&nbsp;
                                            <span class="label label-warning">已用：1 套</span>&nbsp;&nbsp;
                                        </div>
                                        <div style=" margin-top: 20px;"></div>
                                        @endforeach
                                    </td>
                                    <td>{{$value->created_at}}</td>
                                    <td class="text-right">
                                        <button class="btn btn-info btn-xs" id="addBtn"><i class="icon-arrow-down"></i>&nbsp;&nbsp;程序划入</button>
                                        <button class="btn btn-primary btn-xs" id="minuBtn"><i class="icon-arrow-up"></i>&nbsp;&nbsp;程序划出</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="99">
                                        <ul class="pagination pull-right">
                                            {{$list->links()}}
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form class="form-horizontal tasi-form" method="get">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">程序划入</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal tasi-form" method="get">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商户名称</label>
                                <div class="col-sm-9">
                                    <input type="text" value="刘记鸡煲王" placeholder="商户名称" class="form-control" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">套餐名称</label>
                                <div class="col-sm-9">
                                    <input type="text" value="零壹科技餐饮系统" placeholder="套餐名称" class="form-control" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">零壹新科技餐饮总店系统</label>
                                <div class="col-sm-2">
                                    <input type="text" value="0" class="form-control" >
                                </div>
                                <label class="col-sm-2 control-label">套</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">零壹新科技餐饮店铺系统</label>
                                <div class="col-sm-2">
                                    <input type="text" value="0"  class="form-control">
                                </div>
                                <label class="col-sm-2 control-label">套</label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">安全密码</label>
                                <div class="col-sm-9">
                                    <input type="password" value="" placeholder="安全密码" class="form-control" >
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                        <button class="btn btn-success" type="button" id="save_btn">确定</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form class="form-horizontal tasi-form" method="get">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">程序划出</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal tasi-form" method="get">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商户名称</label>
                                <div class="col-sm-9">
                                    <input type="text" value="刘记鸡煲王" placeholder="商户名称" class="form-control" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">套餐名称</label>
                                <div class="col-sm-9">
                                    <input type="text" value="零壹科技餐饮系统" placeholder="套餐名称" class="form-control" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">零壹新科技餐饮总店系统</label>
                                <div class="col-sm-2">
                                    <input type="text" value="0" class="form-control" >
                                </div>
                                <label class="col-sm-2 control-label">套</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">零壹新科技餐饮店铺系统</label>
                                <div class="col-sm-2">
                                    <input type="text" value="0"  class="form-control">
                                </div>
                                <label class="col-sm-2 control-label">套</label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">安全密码</label>
                                <div class="col-sm-9">
                                    <input type="password" value="" placeholder="安全密码" class="form-control" >
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                        <button class="btn btn-success" type="button" id="save_bt">确定</button>
                    </div>
                </div>
            </div>
        </form>
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

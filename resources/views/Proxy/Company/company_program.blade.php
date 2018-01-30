<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>零壹新科技服务商管理平台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/Proxy')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/Proxy')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('public/Proxy')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>

    <!-- Custom styles for this template -->
    <link href="{{asset('public/Proxy')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Proxy')}}/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('public/Proxy')}}/js/html5shiv.js"></script>
    <script src="{{asset('public/Proxy')}}/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        @include('Proxy/Public/Header')
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        @include('Proxy/Public/Nav')
    </aside>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-code"></i> 下辖商户管理</a></li>
                        <li class="active">程序划拨管理</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <button type="button" class="btn btn-info" onclick="location.href='company_list.html'"><i class="icon-reply"></i> 返回列表</button>
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        商户："刘记鸡煲王"程序划拨
                                    </header>
                                    <table class="table table-hover">
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
                                                        <span class="label label-danger"><i class="icon-code"></i> 零壹新科技餐饮店铺系统</span> &nbsp;&nbsp;
                                                        <span class="label label-primary">剩余：@if(!empty($v->program_spare_num)){{$v->program_spare_num}}@else 0 @endif 套</span>&nbsp;&nbsp;
                                                        <span class="label label-warning">已用：@if(!empty($v->program_use_num)){{$v->program_use_num}}@else 0 @endif 套</span>&nbsp;&nbsp;
                                                    </div>
                                                    <div style=" margin-top: 30px;"></div>
                                                @endforeach

                                            </td>
                                            <td>{{$value->created_at}}</td>
                                            <td class="text-right">
                                                <button class="btn btn-info btn-xs" id="addBtn" onclick="getAssetsAdd('{{$value->id}}','1')"><i class="icon-arrow-down"></i>&nbsp;&nbsp;程序划入</button>
                                                <button class="btn btn-primary btn-xs" id="minuBtn" onclick="getAssetsReduce('{{$value->id}}','0')"><i class="icon-arrow-up"></i>&nbsp;&nbsp;程序划出</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        @endforeach
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
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </div>





        </section>
    </section>
    <!--main content end-->
</section>
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
                    <button class="btn btn-success" type="button" id="save_btn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Proxy')}}/js/jquery.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('public/Proxy')}}/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="{{asset('public/Proxy')}}/js/common-scripts.js"></script>


<script>

    //owl carousel

    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>
</body>
</html>

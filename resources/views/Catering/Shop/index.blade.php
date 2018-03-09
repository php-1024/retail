<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Catering/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Catering')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Catering')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Catering')}}/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        @include('Catering/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        @include('Catering/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">总店概况</h3>
                        </div>

                        <div class="col-lg-3">
                            <section class="panel panel-default">

                                <header class="panel-heading font-bold">
                                    概况

                                    <button id="editBtn" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit "></i>&nbsp;编辑</button>
                                </header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="get">
                                        <div class="form-group clearfix text-center m-t">
                                            <div class="inline">
                                                <div class="thumb-lg" >
                                                    <img src="{{asset('public/Catering')}}/img/a5.png" class="img-circle" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">模式</label>
                                            <div class="col-sm-8">
                                                <div>
                                                    <label class="label label-success m-t-xs">
                                                        餐饮系统【先吃后付】
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">总店名称</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">刘记鸡煲王</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">负责人</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">张老三</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">手机号码</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">13123456789</label>
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">状态</label>
                                            <div class="col-sm-8">
                                                <label class="label label-danger">未关联公众服务号</label>
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">公众号</label>
                                            <div class="col-sm-8">
                                                <label class="label label-danger">未关联</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">微支付</label>
                                            <div class="col-sm-8">
                                                <label class="label label-danger">未设置</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">零舍壹得</label>
                                            <div class="col-sm-8">
                                                <label class="label label-danger">未设置</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">总店</label>
                                            <div class="col-sm-8">
                                                <label class="label label-danger">未创建</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">允许分店数</label>
                                            <div class="col-sm-8">
                                                <label class="label label-danger">10间</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-9 ">
                            <div class="col-lg-12">
                                <div class="col-lg-4 state-overview"">
                                <section class="panel">
                                    <div class="symbol bg-danger">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="value">
                                        <h1>1688888.03</h1>
                                        <p>元 总营收</p>
                                    </div>
                                </section>
                            </div>

                            <div class="col-lg-4 state-overview"">
                            <section class="panel">
                                <div class="symbol bg-success">
                                    <i class="icon icon-user"></i>
                                </div>
                                <div class="value">
                                    <h1>1680</h1>
                                    <p>个粉丝</p>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-4 state-overview">
                        <section class="panel">
                            <div class="symbol bg-info">
                                <i class="fa fa-cutlery"></i>
                            </div>
                            <div class="value">
                                <h1>10</h1>
                                <p>间店铺</p>
                            </div>
                        </section>
                        </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <section class="panel panel-default">
                                    <header class="panel-heading">分店营收明细</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>店铺名称</th>
                                            <th>店铺类型</th>
                                            <th>今日成交</th>
                                            <th>今日营收</th>
                                            <th>历史成交</th>
                                            <th>历史营收</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>刘记鸡煲王【龙岗店】</td>
                                            <td><label class="label label-primary">总店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        <tr>
                                            <td>刘记鸡煲王【中心城店】</td>
                                            <td><label class="label label-warning">分店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        <tr>
                                            <td>刘记鸡煲王【中心城店】</td>
                                            <td><label class="label label-warning">分店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        <tr>
                                            <td>刘记鸡煲王【中心城店】</td>
                                            <td><label class="label label-warning">分店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        <tr>
                                            <td>刘记鸡煲王【中心城店】</td>
                                            <td><label class="label label-warning">分店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        <tr>
                                            <td>刘记鸡煲王【中心城店】</td>
                                            <td><label class="label label-warning">分店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        <tr>
                                            <td>刘记鸡煲王【中心城店】</td>
                                            <td><label class="label label-warning">分店</label></td>
                                            <td>111笔</td>
                                            <td>&yen;10000.3</td>
                                            <td>888笔</td>
                                            <td>&yen;88888.33</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading">最近登录日志</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>登录账号</th>
                                            <th>登录IP</th>
                                            <th>登录地址</th>
                                            <th>登录时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($login_log_list as $key=>$val)
                                        <tr>
                                            <td>{{  $val->accounts->account }}</td>
                                            <td>{{  long2ip($val->ip) }}</td>
                                            <td>{{  $val->ip_position }}</td>
                                            <td>{{  $val->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            </div>

                            <div class="col-lg-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading">最近操作日志</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>操作账号</th>
                                            <th>操作内容</th>
                                            <th>操作时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($operation_log_list as $key=>$val)
                                            <tr>
                                                <td>{{ $val->accounts->account }}</td>
                                                <td>{{ $val->operation_info }}</td>
                                                <td>{{ $val->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">店铺信息编辑</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">店铺名称</label>
                            <div class="col-sm-10">
                                <input type="text" value="刘记鸡煲王" placeholder="店铺名称" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">负责人</label>
                            <div class="col-sm-10">
                                <input type="text" value="张老三" placeholder="负责人" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">手机号码</label>
                            <div class="col-sm-10">
                                <input type="text" value="13123456789" placeholder="手机号码" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">店铺LOGO</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                            </div>
                        </div>

                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                            </div>
                        </div>
                        <div style="clear:both;"></div>

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
<script src="{{asset('public/Catering')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Catering')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Catering')}}/js/app.js"></script>
<script src="{{asset('public/Catering')}}/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Catering')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Catering')}}/js/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/demo.js"></script>
<script src="{{asset('public/Proxy/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#save_btn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
</script>
</body>
</html>

























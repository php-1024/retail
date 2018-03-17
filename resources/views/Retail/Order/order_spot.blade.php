<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 零售版店铺管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Branch')}}/library/wizard/css/custom.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch')}}/library/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    {{--头部--}}
    @include('Retail/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('Retail/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">现场订单</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                现场订单查询
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div>
                                        <label class="col-sm-1 control-label">用户账号</label>
                                        <div class="col-sm-2">
                                            <input class="input-sm form-control" size="16" type="text" value="">
                                        </div>
                                        <label class="col-sm-1 control-label">订单编号</label>

                                        <div class="col-sm-2">
                                            <input class="input-sm form-control" size="16" type="text" value="">
                                        </div>
                                        <div class="col-sm-2">
                                            <select name="account" class="form-control m-b">
                                                <option>支付方式</option>
                                                <option>在线余额支付</option>
                                                <option>在线支付</option>
                                                <option>003</option>
                                                <option>004</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-sm-2">
                                            <select name="account" class="form-control m-b">
                                                <option>订单状态</option>
                                                <option>未支付</option>
                                                <option>已支付</option>
                                                <option>已完成</option>
                                                <option>已取消</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>订单编号</th>
                                        <th>用户账号</th>
                                        <th>微信昵称</th>
                                        <th>联系方式</th>
                                        <th>支付方式</th>
                                        <th>订单金额</th>
                                        <th>餐位费</th>
                                        <th>订单状态</th>
                                        <th>下单时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $key=>$val)
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->ordersn}}</td>
                                        <td>{{$val->user->account}}</td>
                                        <td>{{$val->user->UserInfo->nickname}}</td>
                                        <td>{{$val->user->mobile}}</td>

                                        {{--1为余额，2为在线，3为到付,4现场现金， 5现场刷卡，6现场支付宝，7现场微信，8线上手动确认付款--}}
                                        <td><label class="label label-info">
                                        @if($val->paytype==1)
                                            余额支付
                                        @elseif($val->paytype==2)
                                            在线支付
                                        @elseif($val->paytype==3)
                                            货到付款
                                        @elseif($val->paytype==4)
                                            现场现金支付
                                        @elseif($val->paytype==5)
                                            现场刷卡支付
                                        @elseif($val->paytype==6)
                                            现场支付宝支付
                                        @elseif($val->paytype==7)
                                            现场微信支付
                                        @elseif($val->paytype==8)
                                            线上手动确认付款
                                        @endif
                                        </label></td>

                                        <td>{{$val->order_price}}</td>
                                        <td>{{$val->seatfee}}</td>

                                        <th>
                                                {{---1取消状态，0普通状态，1为已付款，2为已发货，3为成功--}}
                                                @if($val->status==-1)
                                                    <label class="label label-default">已取消</label>
                                                @elseif($val->status==0)
                                                    <label class="label label-primary">待付款</label>
                                                @elseif($val->status==1)
                                                    <label class="label label-warning">已付款</label>
                                                @elseif($val->status==2)
                                                    <label class="label label-success">配送中</label>
                                                @elseif($val->status==3)
                                                    <label class="label label-info">已完成</label>
                                                @endif
                                        </th>

                                        <td>{{$val->created_at}}</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn" onclick="location.href='{{url('retail/order/order_spot_detail')}}?id={{$val->id}}'"><i class="fa fa-edit"></i>&nbsp;&nbsp;查看详情</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">

                                    <div class="col-sm-12 text-right text-center-xs">
                                        {{$list->links()}}
                                    </div>
                                </div>
                            </footer>
                        </section>

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
                                <input type="text" value="刘记鸡煲王【龙岗店】" placeholder="店铺名称" class="form-control">
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
                            <label class="col-sm-2 text-right">店铺地址</label>
                            <div class="col-sm-10">
                                <input type="text" value="广东省深圳市龙岗区万汇大厦1606" placeholder="店铺地址" class="form-control">
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
<!-- App -->
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/library/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch')}}/library/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/wizard/js/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        $('.selected_btn').click(function(){
            $('.selected_btn').removeClass('btn-success').addClass('btn-info');
            $(this).addClass('btn-success').removeClass('btn-info');
        });
        $('.selected_table').click(function(){
            $('.selected_table').removeClass('btn-success').addClass('btn-info');
            $(this).addClass('btn-success').removeClass('btn-info');
        });
    });
</script>
</body>
</html>
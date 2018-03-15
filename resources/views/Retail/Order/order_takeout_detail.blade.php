<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 分店业务系统</title>
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
                            <h3 class="m-b-none">外卖订单详情</h3>
                        </div>
                        <div class="row row-sm">
                            <button class="btn btn-s-md btn-success" type="button" onclick="location.href='order_takeout'" id="addBtn"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                        </div>
                        <div class="col-lg-4">
                            <section class="panel panel-default">

                                <header class="panel-heading font-bold">
                                    外卖订单详情
                                </header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="get">

                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">订单编号</label>
                                            <div class="col-sm-9">
                                                <div>

                                                    10002000300040005

                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">用户账号</label>
                                            <div class="col-sm-9">
                                                <div>

                                                    100020

                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">微信昵称</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    时光取名叫无心
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">联系方式</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    13123456789
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">支付方式</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    <label class="label label-info">在线余额支付</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">订单状态</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    <label class="label label-primary">未付款</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">下单时间</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    <label class="label label-primary">2017-08-09 11:11:11</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">订单备注</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    <label class="label label-danger">不要辣</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 text-right" for="input-id-1">配送详情</label>
                                            <div class="col-sm-9">
                                                <div>
                                                    <label class="label label-danger">广东省深圳市龙岗区万汇大厦1606，薛志豪，1312345678</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-success" type="button" id="addBtn"><i class="fa fa-check"></i>&nbsp;&nbsp;确认付款</button>
                                            <button class="btn btn-primary" type="button" id="addBtn"><i class="fa fa-check"></i>&nbsp;&nbsp;完成订单</button>
                                            <button class="btn btn-default" type="button" id="addBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;取消订单</button>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-8">
                            <section class="panel panel-default">
                                <header class="panel-heading font-bold">
                                    购物车 刘新文 003号桌 12人
                                </header>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>商品标题</th>
                                            <th>数量</th>
                                            <th>规格</th>
                                            <th>商品价格</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>奇味鸡煲</td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                米饭 + 辣
                                            </td>
                                            <td>
                                                <input class="input-sm form-control" style="width: 50px;" type="text" value="50">
                                            </td>
                                            <th>
                                                <select name="account" style="width: 100px;" class="form-control form-xs m-b text-xs">
                                                    <option>待上菜</option>
                                                    <option>已上菜</option>
                                                </select>
                                            </th>
                                            <td>
                                                <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-plus"></i></button>
                                                <input type="text" id="exampleInputPassword2" class="text-center" value="1" size="4">
                                                <button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-minus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>麻辣鸡煲</td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                米饭 + 辣
                                            </td>
                                            <td>
                                                <input class="input-sm form-control" style="width: 50px;" type="text" value="50">
                                            </td>
                                            <th>
                                                <select name="account" style="width: 100px;" class="form-control form-xs m-b text-xs">
                                                    <option>待上菜</option>
                                                    <option>已上菜</option>
                                                </select>
                                            </th>
                                            <td>
                                                <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-plus"></i></button>
                                                <input type="text" id="exampleInputPassword2" class="text-center" value="1" size="4">
                                                <button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-minus"></i></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td><label class="label label-info">商品总计</label></td>
                                            <td>
                                                <label class="label label-danger">¥100000.00</label>
                                            </td>
                                            <td></td>
                                            <td><label class="label label-danger">2份</label></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label class="label label-info">送餐费</label></td>

                                            <td>
                                                <label class="label label-danger">¥12.00</label>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label class="label label-info">总计</label></td>
                                            <td>
                                                <label class="label label-danger">¥100012.00</label>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-info btn-xs" type="button" id="addBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;加减菜</button>
                                                <button class="btn btn-danger btn-xs" type="button" id="addBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;修改价格</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
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
                            <label class="col-sm-2 text-right">分店名称</label>
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
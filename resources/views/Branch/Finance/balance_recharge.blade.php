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
    @include('Branch/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('Branch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">余额充值扣费</h3>
                        </div>
                        <button class="btn btn-s-md btn-success" type="button" onclick="location.href='balance'"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="row">
                            <div class="col-sm-4">
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">
                                        余额充值扣费
                                    </header>
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="get">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">用户账号</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="input-id-1" disabled="" value="100021">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">微信昵称</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="input-id-1" disabled="" value="时光取名叫无心">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">操作选项</label>
                                                <div class="col-sm-9">
                                                    <select name="account" class="form-control m-b">
                                                        <option>普通余额</option>
                                                        <option>钻石会员卡</option>
                                                        <option>黄金会员卡</option>
                                                        <option>白银会员卡</option>
                                                        <option>青铜会员卡</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">操作类型</label>
                                                <div class="col-sm-9">
                                                    <select name="account" class="form-control m-b">
                                                        <option>充值</option>
                                                        <option>扣费</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">余额</label>
                                                <div class="col-sm-9">
                                                    <label class="label-success label">100.00元</label>

                                                </div>

                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">充值金额</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="input-id-1" value="100.00">
                                                    <span class="help-block m-b-none">充值金额只保留到小数点后2位</span>
                                                </div>

                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">备注</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="input-id-1" value="">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="input-id-1">安全密码</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="input-id-1" value="">
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>

                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-5">

                                                    <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-8">
                                <section class="panel panel-default">
                                    <header class="panel-heading">
                                        余额充值消费记录
                                    </header>

                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>用户账号</th>
                                                <th>操作类型</th>
                                                <th>操作选项</th>
                                                <th>操作店铺</th>
                                                <th>金额</th>
                                                <th>备注</th>
                                                <th>时间</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>100021</td>
                                                <td><label class="label label-success">系统充值</label></td>
                                                <td><label class="label label-primary">余额</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常充值</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>100021</td>
                                                <td><label class="label label-success">系统充值</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常充值</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>100021</td>
                                                <td><label class="label label-danger">系统扣费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>订单1000200030004000补扣</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>100021</td>
                                                <td><label class="label label-info">用户消费</label></td>
                                                <td><label class="label label-primary">黄金会员卡</label></td>
                                                <td><label class="label label-info">刘记鸡煲王【总店】</label></td>
                                                <td>100.00</td>
                                                <td>正常消费</td>
                                                <td>2018-01-30 11:11:11</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">

                                            <div class="col-sm-12 text-right text-center-xs">
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
                                            </div>
                                        </div>
                                    </footer>
                                </section>
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
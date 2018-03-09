<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Catering')}}/sweetalert/sweetalert.css" rel="stylesheet" />
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
                            <h3 class="m-b-none">粉丝用户管理</h3>
                        </div>

                        <section class="panel panel-default">
                            <header class="panel-heading">
                                粉丝用户管理
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <label class="col-sm-1 control-label">用户账号</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="input-id-1" value="" placeholder="用户账号">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" id="addBtn" class="btn btn-s-md btn-info"><i class="icon icon-magnifier"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>微信头像</th>
                                        <th>用户账号</th>
                                        <th>微信昵称</th>
                                        <th>关注公众号</th>
                                        <th>源头商家</th>
                                        <th>推荐人</th>
                                        <th>粉丝标签</th>
                                        <th>注册时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100020</td>
                                        <td>时光取名叫无心</td>
                                        <td><label class="label label-success">是</label></td>
                                        <td><label class="label label-info">联盟商户-刘记鸡煲王</label></td>
                                        <td><label class="label label-primary">联盟用户-张老三</label></td>
                                        <td>
                                            <select style="width:100px" class="chosen-select2">
                                                <option value="AK">无标签</option>
                                                <option value="AK">粉丝标签1</option>
                                                <option value="HI">粉丝标签2</option>
                                                <option value="HI">粉丝标签3</option>
                                                <option value="HI">粉丝标签4</option>
                                            </select>
                                        </td>
                                        <td>2017-10-22 10:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;粉丝详情</button>
                                            <button class="btn btn-primary btn-xs" id="balanceBtn"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;粉丝钱包</button>
                                            <button class="btn btn-warning btn-xs" id="lockBtn"><i class="fa fa-lock"></i>&nbsp;&nbsp;冻结</button>
                                        </td>
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
                    <h4 class="modal-title">添加粉丝标签</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">用户账号</label>
                            <div class="col-sm-10">
                                <input type="text" value="100020" placeholder="标签名称" class="form-control" disabled="">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">微信昵称</label>
                            <div class="col-sm-10">
                                <input type="text" value="时光取名叫无心" placeholder="安全密码" class="form-control" disabled="">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">源头</label>
                            <div class="col-sm-10">
                                <label class="label label-success">自有店铺-过桥米线</label>
                                <label class="label label-primary">联盟商户-刘记鸡煲王</label>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">推荐人</label>
                            <div class="col-sm-10">
                                <label class="label label-success">自行关注</label>
                                <label class="label label-primary">联盟用户-张老三</label>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">手机号码</label>
                            <div class="col-sm-10">
                                <input type="text" value="" placeholder="QQ号码" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">QQ号码</label>
                            <div class="col-sm-10">
                                <input type="text" value="" placeholder="手机号码" class="form-control">
                            </div>
                        </div>

                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" value="" placeholder="安全密码" class="form-control" >
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

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">粉丝钱包</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">用户账号</label>
                            <div class="col-sm-10">
                                <input type="text" value="100020" placeholder="标签名称" class="form-control" disabled="">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">用户余额</label>
                            <div class="col-sm-10">
                                100元
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">用户积分</label>
                            <div class="col-sm-10">
                                1000分
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>会员卡名称</th>
                                <th>适用店铺范围</th>
                                <th>适用商品范围</th>
                                <th>折扣率</th>
                                <th>余额</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>钻石会员卡</td>
                                <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                                <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                                <td>0.9</td>
                                <td>10000.00元</td>

                            </tr>
                            <tr>
                                <td>1</td>
                                <td>钻石会员卡</td>
                                <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                                <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                                <td>0.9</td>
                                <td>10000.00元</td>

                            </tr>
                            <tr>
                                <td>1</td>
                                <td>钻石会员卡</td>
                                <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                                <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                                <td>0.9</td>
                                <td>10000.00元</td>

                            </tr>
                            <tr>
                                <td>1</td>
                                <td>钻石会员卡</td>
                                <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                                <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                                <td>0.9</td>
                                <td>10000.00元</td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="save_btn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">冻结粉丝确认</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" value="" placeholder="安全密码" class="form-control" >
                                <span class="help-block m-b-none">
                              <p class="text-danger">冻结了粉丝，粉丝将不能继续在店里消费。粉丝去其他联盟商家里消费也没有提成</p>
                          </span>
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
<script type="text/javascript" src="{{asset('public/Catering')}}/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#balanceBtn').click(function(){
            $('#myModal2').modal();
        });
        $('#lockBtn').click(function(){
            $('#myModal3').modal();
        });
        $('.popovers').popover();
    });
</script>
</body>
</html>
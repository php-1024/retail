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
    <link href="{{asset('public/Catering')}}/js/datepicker/datepicker.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/chosen/chosen.css" type="text/css" />
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
                            <h3 class="m-b-none">会员卡管理</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                会员卡列表
                            </header>
                            <div class="row wrapper">

                                <div class="well">
                                    <h3>温馨提示</h3>
                                    <p class="text-danger">1.新生成的会员卡，默认对适用店铺中的所有商品有效，若想调整，请及时调整</p>
                                    <p class="text-danger">2.新生成的会员卡，初始状态为暂停销售，待设置好商品后可以点击开始销售会员卡才会在前端显示</p>
                                    <p class="text-danger">3.已经销售出部分的会员卡将无法删除</p>
                                </div>

                            </div>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div class="col-sm-2">
                                        <select name="account" class="form-control m-b">
                                            <option>所有分店</option>
                                            <option>刘记鸡煲王（总店）</option>
                                            <option>刘记鸡煲王（宝能店）</option>

                                        </select>
                                    </div>
                                    <label class="col-sm-1 control-label">会员卡名称</label>

                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="">
                                    </div>

                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>售价</th>
                                        <th>折扣</th>
                                        <th>适用分店</th>
                                        <th>发行总数</th>
                                        <th>剩余总数</th>
                                        <th>有效期</th>
                                        <th>状态</th>
                                        <th>发行时间</th>

                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>黄金会员卡</td>
                                        <td>
                                            100.00
                                        </td>
                                        <td>
                                            <label class="label label-primary">0.6</label>
                                        </td>
                                        <td>
                                            <p><button data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></p>
                                        </td>
                                        <td>
                                            999
                                        </td>
                                        <td>
                                            666
                                        </td>
                                        <td>
                                            2017-08-09 到 2018-08-09
                                        </td>
                                        <td>
                                            <label class="label label-success">销售中</label>
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn" type="button"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>&nbsp;&nbsp;
                                            <button class="btn btn-primary btn-xs" onclick="location.href='card_goods.html'" id="goodsBtn" type="button"><i class="fa fa-list"></i>&nbsp;&nbsp;调整适用商品</button>&nbsp;&nbsp;
                                            <button class="btn btn-warning btn-xs" id="lockBtn" type="button"><i class="fa fa-lock"></i>&nbsp;&nbsp;停止销售</button>&nbsp;&nbsp;
                                            <button class="btn btn-danger btn-xs" id="deleteBtn" type="button"><i class="fa fa-lock"></i>&nbsp;&nbsp;删除会员卡</button>&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>黄金会员卡</td>
                                        <td>
                                            100.00
                                        </td>
                                        <td>
                                            <label class="label label-primary">0.6</label>
                                        </td>
                                        <td>
                                            <p><button data-original-title="适用分店" data-content="刘记鸡煲王（宝能店），刘记鸡煲王（总店）" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">2个分店</button></p>
                                        </td>
                                        <td>
                                            999
                                        </td>
                                        <td>
                                            666
                                        </td>
                                        <td>
                                            2017-08-09 到 2018-08-09
                                        </td>
                                        <td>
                                            <label class="label label-warning">销售停止</label>
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" type="button"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>&nbsp;&nbsp;
                                            <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-list"></i>&nbsp;&nbsp;调整适用商品</button>&nbsp;&nbsp;
                                            <button class="btn btn-success btn-xs" type="button"><i class="fa fa-lock"></i>&nbsp;&nbsp;开始销售</button>&nbsp;&nbsp;
                                            <button class="btn btn-danger btn-xs" type="button"><i class="fa fa-lock"></i>&nbsp;&nbsp;删除会员卡</button>&nbsp;&nbsp;
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
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑会员卡</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">会员卡名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" placeholder="会员卡名称">
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">折扣比率</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" placeholder="0 - 1 间的 2位小数">
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">发行数量</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" >
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">会员卡价格</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" >
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">有效时间</label>
                            <div class="col-sm-3">
                                <input class="input-sm datepicker-input form-control" size="16" type="text" value="" placeholder="开始时间" data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="col-sm-1 text-center" style="padding-top: 7px;">
                                到
                            </div>
                            <div class="col-sm-3">
                                <input class="input-sm datepicker-input form-control" size="16" type="text" value="" placeholder="结束时间" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class= "col-sm-2 control-label" for="input-id-1">适用店铺范围</label>
                            <div class="col-sm-10">
                                <select multiple class="chosen-select2 col-sm-12">
                                    <option value="AK" selected="selected">所有店铺</option>
                                    <option value="HI">刘记鸡煲王（总店）</option>
                                    <option value="CA">刘记鸡煲王（宝能店）</option>
                                </select>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" >
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

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">停止销售会员卡确定</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                                <span class="help-block m-b-none">
                              <p class="text-danger">停止销售会员卡，将停止在页面的会员卡销售，已经购买了会员卡的用户可以继续使用</p>
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
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">删除会员卡确定</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                                <span class="help-block m-b-none">
                              <p class="text-danger">只有 未销售出去 或 未开始销售的会员卡才可以删除。</p>
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
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/datepicker/bootstrap-datepicker.js"></script>
<script src="{{asset('public/Catering')}}/js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){

            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
        $('.chosen-select2').chosen({width:"100%"});
        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#lockBtn').click(function(){
            $('#myModal3').modal();
        });
        $('#deleteBtn').click(function(){
            $('#myModal4').modal();
        });
        $('.popovers').popover();
    });
</script>
</body>
</html>

























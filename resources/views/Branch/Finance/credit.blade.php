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
                            <h3 class="m-b-none">积分管理</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                积分管理
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
                                        <th>积分余额</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="images/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100021</td>
                                        <td>时光取名叫无心</td>
                                        <td>
                                            <p><label class="label label-success">100.00元</label></p>

                                        </td>

                                        <td>
                                            <button class="btn btn-primary btn-xs" id="balanceBtn" onclick="location.href='credit_recharge.html'"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;充值扣费</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><img src="images/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100020</td>
                                        <td>时光取名叫无心</td>
                                        <td>
                                            <p><label class="label label-success">100.00元</label></p>

                                        </td>

                                        <td>
                                            <button class="btn btn-primary btn-xs" id="balanceBtn" onclick="location.href='credit_recharge.html'"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;充值扣费</button>
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
<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Retail')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Retail')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Retail')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Retail')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Retail')}}/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        @include('Retail/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        @include('Retail/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">余额管理</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                余额管理
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
                                        <th>余额</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="{{asset('public/Retail')}}/img/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100021</td>
                                        <td>时光取名叫无心</td>
                                        <td>
                                            <p><label class="label label-success">普通余额：100.00元</label></p>
                                            <p><label class="label label-success">钻石会员卡：100.00元</label></p>
                                            <p><label class="label label-success">黄金会员卡：100.00元</label></p>
                                            <p><label class="label label-success">白银会员卡：100.00元</label></p>
                                            <p><label class="label label-success">青铜会员卡：100.00元</label></p>
                                        </td>

                                        <td>
                                            <button class="btn btn-primary btn-xs" id="balanceBtn" onclick="location.href='{{url('Retail/finance/balance_recharge')}}'"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;余额详情</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><img src="{{asset('public/Retail')}}/img/m1.jpg" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                        <td>100020</td>
                                        <td>时光取名叫无心</td>
                                        <td>
                                            <p><label class="label label-success">普通余额：100.00元</label></p>
                                            <p><label class="label label-success">钻石会员卡：100.00元</label></p>
                                            <p><label class="label label-success">黄金会员卡：100.00元</label></p>
                                            <p><label class="label label-success">白银会员卡：100.00元</label></p>
                                            <p><label class="label label-success">青铜会员卡：100.00元</label></p>
                                        </td>

                                        <td>
                                            <button class="btn btn-primary btn-xs" id="balanceBtn" onclick="location.href='{{url('Retail/finance/balance_recharge')}}'"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;余额详情</button>
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
<script src="{{asset('public/Retail')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Retail')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Retail')}}/js/app.js"></script>
<script src="{{asset('public/Retail')}}/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Retail')}}/js/app.plugin.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/js/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/sweetalert/sweetalert.min.js"></script>
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

























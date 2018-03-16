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
        @include('Fansmanage/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        @include('Fansmanage/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">佣金管理</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                佣金管理
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div class="col-sm-2">
                                        <select name="account" class="form-control m-b">
                                            <option>选择类型</option>
                                            <option>流量共享佣金</option>
                                            <option>流量动力佣金</option>
                                        </select>
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
                                        <th>类型</th>
                                        <th>金额</th>
                                        <th>来源备注</th>
                                        <th>时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量共享佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心到联盟商户消费</label>

                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量动力佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心推荐他人到联盟商户消费</label>
                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量动力佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心推荐他人到联盟商户消费</label>
                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量动力佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心推荐他人到联盟商户消费</label>
                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量动力佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心推荐他人到联盟商户消费</label>
                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量动力佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心推荐他人到联盟商户消费</label>
                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><label class="label-success label">流量动力佣金</label></td>
                                        <td>2.00元</td>

                                        <td>
                                            <label class="label label-primary">粉丝时光取名叫无心推荐他人到联盟商户消费</label>
                                        </td>

                                        <td>
                                            2018-01-30 11:11:11
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

























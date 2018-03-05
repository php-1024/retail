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
                            <h3 class="m-b-none">商品查询</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                商品列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div class="col-sm-2">
                                        <select name="account" class="form-control m-b">
                                            <option>所有分店</option>
                                            <option>总店</option>
                                            <option>宝能店</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="account" class="form-control m-b">
                                            <option>所有分类</option>
                                            <optgroup label="总店">
                                                <option value="AK">主食</option>
                                                <option value="HI">酒水饮料</option>
                                            </optgroup>
                                            <optgroup label="宝能店">
                                                <option value="AK">主食</option>
                                                <option value="HI">饮料</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 control-label">商品标题</label>

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
                                        <th>商品标题</th>
                                        <th>商品价格</th>
                                        <th>商品分类</th>
                                        <th>库存</th>
                                        <th>排序</th>
                                        <th>商品状态</th>
                                        <th>隶属分店</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>奇味鸡煲</td>
                                        <td>
                                            100.00
                                        </td>
                                        <td>
                                            <label class="label label-info">主食</label>
                                        </td>
                                        <td>
                                            999
                                        </td>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <label class="label label-success">在售</label>
                                        </td>
                                        <td>
                                            <label class="label label-primary">刘记鸡煲王-总店</label>
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn" onclick="location.href='goods_detail.html'"><i class="fa fa-edit"></i>&nbsp;&nbsp;查看详情</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>奇味鸡煲</td>
                                        <td>
                                            100.00
                                        </td>
                                        <td>
                                            <label class="label label-info">主食</label>
                                        </td>
                                        <td>
                                            999
                                        </td>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <label class="label label-success">在售</label>
                                        </td>
                                        <td>
                                            <label class="label label-primary">刘记鸡煲王-总店</label>
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn" onclick="location.href='goods_detail.html'"><i class="fa fa-edit"></i>&nbsp;&nbsp;查看详情</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>奇味鸡煲</td>
                                        <td>
                                            100.00
                                        </td>
                                        <td>
                                            <label class="label label-info">主食</label>
                                        </td>
                                        <td>
                                            999
                                        </td>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <label class="label label-success">在售</label>
                                        </td>
                                        <td>
                                            <label class="label label-primary">刘记鸡煲王-总店</label>
                                        </td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn" onclick="location.href='goods_detail.html'"><i class="fa fa-edit"></i>&nbsp;&nbsp;查看详情</button>
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

























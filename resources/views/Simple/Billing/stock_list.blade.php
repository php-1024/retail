<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>供应商列表 | 零壹云管理平台 | 零售版店铺管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Simple/library/jPlayer')}}/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple')}}/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Simple/library/sweetalert')}}/sweetalert.css">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Simple/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Simple/library/ie')}}/respond.min.js"></script>
    <script src="{{asset('public/Simple/library/ie')}}/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    @include('Simple/Public/Header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
        @include('Simple/Public/Nav')
        <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">库存查询</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                库存列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get" id="searchForm" action="">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <label class="col-sm-1 control-label">商品名称</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" name="goods_name" value="{{$goods_name}}">
                                    </div>

                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>商品标题</th>
                                        <th>分类</th>
                                        <th>商品条码</th>
                                        <th>商品编号</th>
                                        <th>库存</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stock_list as $key=>$val)
                                    <tr>
                                        <td>{{$val->goods_id}}</td>
                                        @if($val->SimpleGoods == null)
                                            <td style="color:#FF0000">商品已删除</td>
                                        @else
                                        <td>{{$val->SimpleGoods->name}}</td>
                                            @if($val->SimpleCategory == null)
                                                <td style="color:#FF0000">其他</td>
                                            @else
                                                <td>{{$val->SimpleCategory->name}}</td>
                                            @endif
                                        <td>{{$val->SimpleGoods->barcode}}</td>
                                        <td>{{$val->SimpleGoods->number}}</td>
                                        <td>{{$val->stock}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-12 text-right text-center-xs">
                                        @if(!is_array($stock_list))
                                        {!! $stock_list->links() !!}
                                        @endif
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
<script src="{{asset('public/Simple')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Simple')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Simple')}}/js/app.js"></script>
<script src="{{asset('public/Simple/library')}}/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Simple')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Simple/library')}}/file-input/bootstrap-filestyle.min.js"></script>
<script src="{{asset('public/Simple/library')}}/jPlayer/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Simple/library')}}/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Simple/library')}}/sweetalert/sweetalert.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Catering')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/trumbowyg/design/css/trumbowyg.css">
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
                            <h3 class="m-b-none">商品详情</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading text-right bg-light">
                                <ul class="nav nav-tabs pull-left">
                                    <li class="active"><a href="#baseinfo" data-toggle="tab"><i class="fa fa-file-text-o text-muted"></i>&nbsp;&nbsp;基础信息</a></li>
                                    <li><a href="#picture" data-toggle="tab"><i class="icon icon-picture text-muted"></i>&nbsp;&nbsp;商品图片</a></li>
                                    <li><a href="#option" data-toggle="tab"><i class="fa fa-leaf text-muted"></i>&nbsp;&nbsp;商品规格</a></li>
                                    <li><a href="#other" data-toggle="tab"><i class="fa fa-gears text-muted"></i>&nbsp;&nbsp;其他参数</a></li>
                                    <li><a href="#other" data-toggle="tab"><i class="fa fa-gears text-muted"></i>&nbsp;&nbsp;积分管理</a></li>
                                </ul>
                                <span class="hidden-sm">&nbsp;</span>
                            </header>
                            <div class="panel-body">

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="baseinfo">
                                        <form class="form-horizontal" method="get">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品分类</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" disabled="" value="主食">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品名称</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="奇味鸡煲">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">价格</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="100.00">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">库存</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="999">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">排序</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="1">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品详情</label>
                                                <div class="col-sm-8">
                                                    <textarea id="form-content" class="editor" cols="30" rows="10"> </textarea>
                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                    <div class="tab-pane fade in" id="picture">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        图片预览
                                                    </th>
                                                    <th>
                                                        图片链接
                                                    </th>
                                                    <th>
                                                        图片排序
                                                    </th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m0.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image1.png
                                                    </td>
                                                    <td>
                                                        1
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m1.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image2.png
                                                    </td>
                                                    <td>
                                                        2
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m2.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image3.png
                                                    </td>
                                                    <td>
                                                        3
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m3.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image4.png
                                                    </td>
                                                    <td>
                                                        4
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m4.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image5.png
                                                    </td>
                                                    <td>
                                                        5
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m5.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image6.png
                                                    </td>
                                                    <td>
                                                        6
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Catering')}}/img/m6.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image7.png
                                                    </td>
                                                    <td>
                                                        7
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade in" id="option">
                                        <table class="table table-bordered table-stripped">
                                            <thead>
                                            <tr>
                                                <th>
                                                    主食
                                                </th>
                                                <th>
                                                    味道
                                                </th>
                                                <th>
                                                    库存
                                                </th>
                                                <th>
                                                    价格
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td rowspan="4">
                                                    米饭
                                                </td>
                                                <td>
                                                    甜
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    酸
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    苦
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    辣
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="5">
                                                    面
                                                </td>
                                                <td>
                                                    辣
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    特辣
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    变态辣
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    100.00
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade in" id="other">
                                        <form class="form-horizontal" method="get">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">首页展示</label>
                                                <div class="col-sm-8">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">限时秒杀</label>
                                                <div class="col-sm-8">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品编号</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="10002000300004000">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">最大购买数量</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="1">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">搜索关键词</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="input-id-1" value="1">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

<script src="{{asset('public/Catering')}}/trumbowyg/trumbowyg.js"></script>

<script src="{{asset('public/Catering')}}/trumbowyg/plugins/upload/trumbowyg.upload.js"></script>

<script src="{{asset('public/Catering')}}/trumbowyg/plugins/base64/trumbowyg.base64.js"></script>

<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
        $('#form-content').trumbowyg({
            lang: 'fr',
            closable: false,
            mobile: true,
            fixedBtnPane: true,
            fixedFullWidth: true,
            semantic: true,
            resetCss: true,
            autoAjustHeight: true,
            autogrow: true
        });
    });
</script>
</body>
</html>

























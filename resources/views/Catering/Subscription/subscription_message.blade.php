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
                <section class="hbox stretch">
                    <!-- side content -->
                    <aside class="aside bg-dark" id="sidebar">
                        <section class="vbox animated fadeInUp">
                            <section class="scrollable hover">
                                <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                                    <a href="subscription_message.html" class="list-group-item active">
                                        关键词自动回复
                                    </a>
                                    <a href="subscription_message2.html" class="list-group-item">
                                        关注后自动回复
                                    </a>
                                    <a href="subscription_message3.html" class="list-group-item ">
                                        默认回复
                                    </a>
                                    <a href="subscription_message4.html" class="list-group-item ">
                                        消息群发
                                    </a>
                                </div>
                            </section>
                        </section>
                    </aside>
                    <!-- / side content -->
                    <section>
                        <section class="vbox">
                            <section class="scrollable padder-lg">
                                <h2 class="font-thin m-b">关键词自动回复</h2>
                                <div class="row row-sm">
                                    <button class="btn btn-success" id="addKeyWord">新建关键字 &nbsp;&nbsp;<i class="fa fa-plus"></i></button>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>关键词</th>
                                            <th>适配类型</th>
                                            <th>添加时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>测试</td>
                                            <td><label class="label label-success">模糊</label></td>
                                            <td>2017-08-09 11:11:11</td>
                                            <td>
                                                <p>
                                                    <button class="btn btn-info btn-sm" id="addText"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;文本回复</button>
                                                    <button class="btn btn-info btn-sm" id="addArticle"><i class="fa fa-tasks"></i>&nbsp;&nbsp;图文回复</button>
                                                    <button class="btn btn-info btn-sm" id="addPicture"><i class="icon icon-picture"></i>&nbsp;&nbsp;图片回复</button>
                                                    <button class="btn btn-info btn-sm" id="editKeyWord"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑关键字</button>
                                                    <button class="btn btn-danger btn-sm" id="deleteKeyWord"><i class="fa fa-times"></i>&nbsp;&nbsp;删除关键字</button>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>测试</td>
                                            <td><label class="label label-primary">精确</label></td>
                                            <td>2017-08-09 11:11:11</td>
                                            <td>
                                                <div>
                                                    <button class="btn btn-info btn-xs" id="editText"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs" id="deleteMaterial"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                    <label class="label label-primary">文本</label>&nbsp;&nbsp;
                                                    测试图文...&nbsp;&nbsp;

                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div>
                                                    <button class="btn btn-info btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;文本回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="icon icon-picture"></i>&nbsp;&nbsp;图文回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-tasks"></i>&nbsp;&nbsp;图片回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑关键字</button>
                                                    <button class="btn btn-danger btn-sm" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除关键字</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>测试</td>
                                            <td><label class="label label-success">模糊</label></td>
                                            <td>2017-08-09 11:11:11</td>
                                            <td>
                                                <div>
                                                    <button class="btn btn-info btn-xs" id="editArticle"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs" id="deleteBtn2"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                    <label class="label label-primary">图文</label>&nbsp;&nbsp;
                                                    测试回复啊啊啊啊啊...&nbsp;&nbsp;

                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div>
                                                    <button class="btn btn-info btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;文本回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="icon icon-picture"></i>&nbsp;&nbsp;图文回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-tasks"></i>&nbsp;&nbsp;图片回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑关键字</button>
                                                    <button class="btn btn-danger btn-sm" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除关键字</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>测试</td>
                                            <td><label class="label label-success">模糊</label></td>
                                            <td>2017-08-09 11:11:11</td>
                                            <td>
                                                <div>
                                                    <button class="btn btn-info btn-xs" id="editPicture"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button class="btn btn-danger btn-xs" id="deleteBtn2"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                    <label class="label label-primary">图片</label>&nbsp;&nbsp;
                                                    <img src="images/m1.jpg" alt="" class="r r-2x img-full" style="width:100px; height: 100px">&nbsp;&nbsp;

                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div>
                                                    <button class="btn btn-info btn-sm" ><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;文本回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="icon icon-picture"></i>&nbsp;&nbsp;图文回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-tasks"></i>&nbsp;&nbsp;图片回复</button>
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑关键字</button>
                                                    <button class="btn btn-danger btn-sm" id="deleteBtn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除关键字</button>
                                                </div>
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

























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
    <link rel="stylesheet" href="{{asset('public/Retail')}}/trumbowyg/design/css/trumbowyg.css">
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
                <section class="hbox stretch">
                    <!-- side content -->
                    <aside class="aside bg-dark" id="sidebar">
                        <section class="vbox animated fadeInUp">
                            <section class="scrollable hover">
                                <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                                    <a href="{{url('Retail/news/message')}}" class="list-group-item">
                                        关键词自动回复
                                    </a>
                                    <a href="{{url('Retail/news/message_attention')}}" class="list-group-item">
                                        关注后自动回复
                                    </a>
                                    <a href="{{url('Retail/news/message_default')}}" class="list-group-item active">
                                        默认回复
                                    </a>
                                    <a href="{{url('Retail/news/message_mass')}}" class="list-group-item ">
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
                                <h2 class="font-thin m-b">默认回复</h2>
                                <section class="panel panel-default">
                                    <header class="panel-heading">
                                        默认回复
                                    </header>

                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>回复类型</th>
                                                <th>是否启用</th>
                                                <th>回复内容</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>文字回复</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" checked="checked">
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs" id="editText"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;编辑文字</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>图文素材</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs" id="editArticle"><i class="fa fa-tasks"></i>&nbsp;&nbsp;编辑图文</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>图片素材</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs" id="editPicture"><i class="icon icon-picture"></i>&nbsp;&nbsp;编辑图片</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">选择图文素材</h4>
                </div>
                <div class="modal-body">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            图文素材列表
                        </header>

                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                <tr>

                                    <th>素材标题</th>
                                    <th>素材类型</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>测试图文</td>
                                    <td>单条图文</td>
                                    <td>2017-08-09 11:11:11</td>
                                    <td>
                                        <button class="btn btn-info btn-xs" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>测试图文</td>
                                    <td>单条图文</td>
                                    <td>2017-08-09 11:11:11</td>
                                    <td>
                                        <button class="btn btn-info btn-xs" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>测试图文</td>
                                    <td>单条图文</td>
                                    <td>2017-08-09 11:11:11</td>
                                    <td>
                                        <button class="btn btn-info btn-xs" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>测试图文</td>
                                    <td>单条图文</td>
                                    <td>2017-08-09 11:11:11</td>
                                    <td>
                                        <button class="btn btn-info btn-xs" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </section>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">选择图片素材</h4>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg-2">
                            <div class="item">
                                <div class="pos-rlt">
                                    <a href="javascript:;"><img src="{{asset('public/Retail')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                </div>
                                <div class="padder-v">
                                    <span>414631616.JPG</span>
                                </div>
                            </div>
                        </div>
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

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑文本回复</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <textarea id="form-content" class="editor" cols="30" rows="10"> </textarea>
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
<script src="{{asset('public/Retail')}}/trumbowyg/trumbowyg.js"></script>
<script src="{{asset('public/Retail')}}/trumbowyg/plugins/upload/trumbowyg.upload.js"></script>
<script src="{{asset('public/Retail')}}/trumbowyg/plugins/base64/trumbowyg.base64.js"></script>
<script type="text/javascript">
    $(function(){
        $('#editText').click(function(){
            $('#myModal1').modal();
        });
        $('#editArticle').click(function(){
            $('#myModal2').modal();
        });
        $('#editPicture').click(function(){
            $('#myModal3').modal();
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

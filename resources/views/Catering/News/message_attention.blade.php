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
                <section class="hbox stretch">
                    <!-- side content -->
                    <aside class="aside bg-dark" id="sidebar">
                        <section class="vbox animated fadeInUp">
                            <section class="scrollable hover">
                                <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                                    <a href="subscription_message.html" class="list-group-item">
                                        关键词自动回复
                                    </a>
                                    <a href="subscription_message2.html" class="list-group-item active">
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
                                <h2 class="font-thin m-b">关注后自动回复</h2>
                                <section class="panel panel-default">
                                    <header class="panel-heading">
                                        图文素材列表
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
        $('#addKeyWord').click(function(){
            $('#myModal').modal();
        });
        $('#addText').click(function(){
            $('#myModal2').modal();
        });
        $('#addArticle').click(function(){
            $('#myModal3').modal();
        });
        $('#editArticle').click(function(){
            $('#myModal3').modal();
        });
        $('#addPicture').click(function(){
            $('#myModal4').modal();
        });
        $('#editPicture').click(function(){
            $('#myModal4').modal();
        });
        $('#editKeyWord').click(function(){
            $('#myModal5').modal();
        });
        $('#deleteKeyWord').click(function(){
            $('#myModal6').modal();
        });
        $('#deleteMaterial').click(function(){
            $('#myModal7').modal();
        });
        $('#editText').click(function(){
            $('#myModal8').modal();
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
        $('#form-content2').trumbowyg({
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

























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
                <section class="hbox stretch">
                    <!-- side content -->
                    <aside class="aside bg-dark" id="sidebar">
                        <section class="vbox animated fadeInUp">
                            <section class="scrollable hover">
                                <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                                    <a href="{{url('catering/news/message')}}" class="list-group-item ">
                                        关键词自动回复
                                    </a>
                                    <a href="{{url('catering/news/message_attention')}}" class="list-group-item">
                                        关注后自动回复
                                    </a>
                                    <a href="{{url('catering/news/message_default')}}" class="list-group-item ">
                                        默认回复
                                    </a>
                                    <a href="{{url('catering/news/message_mass')}}" class="list-group-item active">
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
                                <h2 class="font-thin m-b">消息群发</h2>
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">
                                        消息群发
                                    </header>
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="get">
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">按用户标签群发</label>
                                                <div class="col-sm-10">
                                                    <select name="account" class="form-control m-b">
                                                        <option>所有人</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">群发类型</label>
                                                <div class="col-sm-10">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-sm btn-info">
                                                            <input type="radio" name="options"><i class="fa fa-check text-active"></i> 公众号消息群发【一月只能发4条】
                                                        </label>

                                                        <label class="btn btn-sm btn-info active" style="margin-left: 10px;">
                                                            <input type="radio" name="options"><i class="fa fa-check text-active"></i> 客服消息群发【48小时内有互动的用户才能收到】
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">群发类型</label>
                                                <div class="col-sm-10">
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading text-right bg-light">
                                                            <ul class="nav nav-tabs pull-left">
                                                                <li class="active"><a href="#text_comment" data-toggle="tab"><i class="fa fa-file-text-o text-muted"></i>&nbsp;&nbsp;文字</a></li>
                                                                <li><a href="#picture_comment" data-toggle="tab"><i class="icon icon-picture text-muted"></i>&nbsp;&nbsp;图片</a></li>
                                                                <li><a href="#article_comment" data-toggle="tab"><i class="fa fa-tasks text-muted"></i>&nbsp;&nbsp;图文</a></li>
                                                            </ul>
                                                            <span class="hidden-sm">&nbsp;</span>
                                                        </header>
                                                        <div class="panel-body">
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade active in" id="text_comment">
                                                                    <textarea id="form-content" class="editor" cols="30" rows="10"> </textarea>
                                                                </div>
                                                                <div class="tab-pane fade" id="picture_comment">
                                                                    <div class="row row-sm">
                                                                        <div class="col-lg-2">
                                                                            <div class="item">
                                                                                <div class="pos-rlt">

                                                                                    <div class="item-overlay opacity r r-2x bg-black">
                                                                                        <div class="text-info padder m-t-sm text-sm">
                                                                                            <i class="fa fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                                                                </div>
                                                                                <div class="padder-v">
                                                                                    <span>414631616.JPG</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="item">
                                                                                <div class="pos-rlt">

                                                                                    <div class="item-overlay opacity r r-2x bg-black">
                                                                                        <div class="text-info padder m-t-sm text-sm">
                                                                                            <i class="fa fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                                                                </div>
                                                                                <div class="padder-v">
                                                                                    <span>414631616.JPG</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="item">
                                                                                <div class="pos-rlt">

                                                                                    <div class="item-overlay opacity r r-2x bg-black">
                                                                                        <div class="text-info padder m-t-sm text-sm">
                                                                                            <i class="fa fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                                                                </div>
                                                                                <div class="padder-v">
                                                                                    <span>414631616.JPG</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="item">
                                                                                <div class="pos-rlt">

                                                                                    <div class="item-overlay opacity r r-2x bg-black">
                                                                                        <div class="text-info padder m-t-sm text-sm">
                                                                                            <i class="fa fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                                                                </div>
                                                                                <div class="padder-v">
                                                                                    <span>414631616.JPG</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="item">
                                                                                <div class="pos-rlt">

                                                                                    <div class="item-overlay opacity r r-2x bg-black">
                                                                                        <div class="text-info padder m-t-sm text-sm">
                                                                                            <i class="fa fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                                                                </div>
                                                                                <div class="padder-v">
                                                                                    <span>414631616.JPG</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="item">
                                                                                <div class="pos-rlt">

                                                                                    <div class="item-overlay opacity r r-2x bg-black">
                                                                                        <div class="text-info padder m-t-sm text-sm">
                                                                                            <i class="fa fa-check text-success"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                                                                </div>
                                                                                <div class="padder-v">
                                                                                    <span>414631616.JPG</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="tab-pane fade" id="article_comment">
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
                                                                                <button class="btn btn-info btn-xs choose_btn"  type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>测试图文</td>
                                                                            <td>单条图文</td>
                                                                            <td>2017-08-09 11:11:11</td>
                                                                            <td>
                                                                                <button class="btn btn-info btn-xs choose_btn" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>测试图文</td>
                                                                            <td>单条图文</td>
                                                                            <td>2017-08-09 11:11:11</td>
                                                                            <td>
                                                                                <button class="btn btn-info btn-xs choose_btn" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>测试图文</td>
                                                                            <td>单条图文</td>
                                                                            <td>2017-08-09 11:11:11</td>
                                                                            <td>
                                                                                <button class="btn btn-info btn-xs choose_btn" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="input-id-1" value="">
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>

                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-6">

                                                    <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                        </form>
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
        $('.item').click(function(){
            $('.item').find('.item-overlay').hide();
            $(this).find('.item-overlay').show();
        });
        $('.choose_btn').click(function(){
            $('.choose_btn').removeClass('btn-success').addClass('btn-info');
            $(this).removeClass('btn-info').addClass('btn-success');
        });
    });
</script>
</body>
</html>

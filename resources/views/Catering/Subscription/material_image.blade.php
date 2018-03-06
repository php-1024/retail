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
    <link href="{{asset('public/Catering')}}/ladda/ladda-themeless.min.css" rel="stylesheet">
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
                                    <a href="{{url('catering/subscription/material_image')}}" class="list-group-item active">
                                        图片素材
                                    </a>
                                    <a href="{{url('catering/subscription/material_writing')}}" class="list-group-item ">
                                        图文素材
                                    </a>

                                </div>
                            </section>
                        </section>
                    </aside>
                    <!-- / side content -->
                    <section>
                        <section class="vbox">
                            <section class="scrollable padder-lg">
                                <h2 class="font-thin m-b">图片素材</h2>
                                <div class="row row-sm">
                                    <button class="btn btn-s-md btn-success" type="button" id="addBtn">上传图片 &nbsp;&nbsp;<i class="fa fa-upload"></i></button>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                                <div class="row row-sm">
                                    <div class="col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                        <div class="item">
                                            <div class="pos-rlt">
                                                <a href="track-detail.html"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
                                            </div>
                                            <div class="padder-v">
                                                <span>414631616.JPG</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="pagination pagination">
                                    <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                                </ul>
                            </section>
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
                    <h4 class="modal-title">上传本地图片</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">

                        <div class="form-group">
                            <label class="col-sm-2 text-right">本地图片</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                            </div>
                        </div>

                        <div style="clear:both;"></div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="ladda-button btn btn-success" type="button" data-style="expand-right"><span class="ladda-label">提交</span><span class="ladda-spinner"></span></button>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script src="{{asset('public/Catering')}}/js/file-input/bootstrap-filestyle.min.js"></script>






<!-- Ladda -->
<script src="{{asset('public/Catering')}}/ladda/spin.min.js"></script>
<script src="{{asset('public/Catering')}}/ladda/ladda.min.js"></script>
<script src="{{asset('public/Catering')}}/ladda/ladda.jquery.min.js"></script>

<script type="text/javascript">
    $(function(){
        var l = $( '.ladda-button' ).ladda();
        l.click(function(){

            // Start loading
            l.ladda( 'start' );
            setTimeout(function(){
                l.ladda('stop');
            },12000);
        });

        $('#addBtn').click(function(){
            $('#myModal').modal();
        });
    });
</script>
</body>
</html>

























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
                                    <a href="{{url('api/catering/auto_reply')}}" class="list-group-item">
                                        关键词自动回复
                                    </a>
                                    <a href="{{url('api/catering/subscribe_reply')}}" class="list-group-item active">
                                        关注后自动回复
                                    </a>
                                    <a href="{{url('api/catering/default_reply')}}" class="list-group-item ">
                                        默认回复
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
                                        <input type="hidden" id="id" value="@if(!empty($info)){{$info['id']}}@endif">
                                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="_token" id="subscribe_reply_text_edit_url" value="{{ url('api/ajax/subscribe_reply_text_edit') }}">
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
                                                        <input type="checkbox" disabled class="reply_type" autocomplete="off" value="1" @if(!empty($info) && $info['reply_type']=='1') checked="checked" @endif>
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs "  id="editText" onclick="return getEditTextForm();"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;编辑文字</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>图文素材</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" disabled autocomplete="off" class="reply_type" value="3" @if(!empty($info) && $info['reply_type']=='3') checked="checked" @endif>
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
                                                        <input type="checkbox" disabled autocomplete="off"  class="reply_type" value="2" @if(!empty($info) && $info['reply_type']=='2') checked="checked" @endif>
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
                                    <a href="javascript:;"><img src="{{asset('public/Catering')}}/img/m1.jpg" alt="" class="r r-2x img-full"></a>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

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
    //弹出文本输入框
    function getEditTextForm(){
        var url = $('#subscribe_reply_text_edit_url').val();
        var token = $('#_token').val();
        var data = {'_token':token};
        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>
</body>
</html>

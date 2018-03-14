<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>添加商品 | 零壹云管理平台 | 商户管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch/library/jPlayer')}}/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch/library/sweetalert')}}/sweetalert.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/Branch/library/trumbowyg')}}/design/css/trumbowyg.css">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Branch/library/ie')}}/respond.min.js"></script>
    <script src="{{asset('public/Branch/library/ie')}}/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    @include('CateringBranch/Public/Header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('CateringBranch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">添加商品</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading text-right bg-light">
                                <ul class="nav nav-tabs pull-left">
                                    <li class="active"><a href="#baseinfo" data-toggle="tab"><i class="fa fa-file-text-o text-muted"></i>&nbsp;&nbsp;基础信息</a></li>
                                </ul>
                                <span class="hidden-sm">&nbsp;</span>
                            </header>
                            <div class="panel-body">

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="baseinfo">
                                        <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('cateringbranch/ajax/goods_add_check') }}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品分类</label>
                                                <div class="col-sm-8">
                                                    <select name="category_id" class="form-control m-b">
                                                        <option value ="0">请选择</option>
                                                        @foreach($category as $key=>$val)
                                                        <option value ="{{$val->id}}">{{$val->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品名称</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">价格</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="price">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">库存</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="stock">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">排序</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="displayorder">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品详情</label>
                                                <div class="col-sm-8">
                                                    <textarea id="form-content" name="details" class="editor" cols="30" rows="10"> </textarea>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-6">
                                                    <button type="button" class="btn btn-success" onclick="return postForm();">保存信息</button>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加规格</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">规格名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="addBtn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">确认删除</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="addBtn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal tasi-form" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑规格</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">规格名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-id-1" value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="addBtn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch/library')}}/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch/library')}}/file-input/bootstrap-filestyle.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Branch/library')}}/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('public/Branch/library')}}/trumbowyg/trumbowyg.js"></script>
<script src="{{asset('public/Branch/library')}}/trumbowyg/plugins/upload/trumbowyg.upload.js"></script>
<script src="{{asset('public/Branch/library')}}/trumbowyg/plugins/base64/trumbowyg.base64.js"></script>
<script>

    $(document).ready(function() {
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
        $(".addBtn").click(function(){
            $('#myModal').modal();
        });
        $(".deleteBtn").click(function(){
            $('#myModal1').modal();
        });
        $(".editBtn").click(function(){
            $('#myModal2').modal();
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

    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.href = "{{asset("cateringbranch/goods/goods_list")}}";
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
            }
        });
    }
</script>
</body>
</html>
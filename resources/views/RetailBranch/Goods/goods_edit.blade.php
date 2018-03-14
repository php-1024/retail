<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>编辑商品 | 零壹云管理平台 | 商户管理系统</title>
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
    @include('RetailBranch/Public/Header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('RetailBranch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">添加商品</h3>
                        </div>
                        <div class="row row-sm">
                            <button class="btn btn-s-md btn-success" type="button" onclick="history.back()" id="addBtn"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading text-right bg-light">
                                <ul class="nav nav-tabs pull-left">
                                    <li class="active"><a href="#baseinfo" data-toggle="tab"><i class="fa fa-file-text-o text-muted"></i>&nbsp;&nbsp;基础信息</a></li>
                                    <li><a href="#picture" data-toggle="tab"><i class="icon icon-picture text-muted"></i>&nbsp;&nbsp;商品图片</a></li>
                                    <li><a href="#option" data-toggle="tab"><i class="fa fa-leaf text-muted"></i>&nbsp;&nbsp;商品规格</a></li>
                                    <li><a href="#other" data-toggle="tab"><i class="fa fa-gears text-muted"></i>&nbsp;&nbsp;其他参数</a></li>
                                </ul>
                                <span class="hidden-sm">&nbsp;</span>
                            </header>
                            <div class="panel-body">

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="baseinfo">
                                        <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('retailbranch/ajax/goods_edit_check') }}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="goods_id" value="{{$goods->id}}">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品分类</label>
                                                <div class="col-sm-8">
                                                    <select name="category_id" class="form-control m-b">
                                                        <option value ="0">请选择</option>
                                                        @foreach($category as $key=>$val)
                                                            <option value ="{{$val->id}}" @if($val->id == $goods->category->id)selected @endif>{{$val->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品名称</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name" value="{{$goods->name}}">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">价格</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="price" value="{{$goods->price}}">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">库存</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="stock" value="{{$goods->stock}}">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">排序</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="displayorder" value="{{$goods->displayorder}}">
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品详情</label>
                                                <div class="col-sm-8">
                                                    <textarea id="form-content" name="details" class="editor" cols="30" rows="10"> {{$goods->details}}</textarea>
                                                </div>
                                            </div>

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-6">
                                                    <button type="button" class="btn btn-success" onclick="return postEditForm();">保存信息</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade in" id="picture">
                                        <button type="button" class="btn btn-success" onclick="return addthumb();"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加图片</button>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div id="thumb_content">
                                        @include('Branch/Goods/goods_thumb_list')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade in" id="option">
                                        <button type="button" class="btn btn-info" onclick="addSpec()">添加规格&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div id="spec_content">
                                            {{--规格列表--}}
                                            @include('Branch/Goods/goods_spec_list')
                                            {{--规格列表--}}
                                        </div>
                                        <table class="table table-bordered table-stripped">
                                            <thead>
                                            <tr>
                                                <th>主食</th>
                                                <th>味道</th>
                                                <th>库存</th>
                                                <th>价格</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td rowspan="4">米饭</td>
                                                <td>甜</td>
                                                <td>999</td>
                                                <td>100.00</td>
                                            </tr>
                                            <tr>
                                                <td>酸</td>
                                                <td>999
                                                </td><td>100.00</td>
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

                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-6">

                                                    <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
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



{{--添加规格类--}}
<div class="modal fade" id="myModal_Spec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" class="form-horizontal"  role="form" id="spec_add" action="{{ url('retailbranch/ajax/spec_add_check') }}">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <input type="hidden" name="goods_id" id="goods_id" value="{{$goods->id}}">
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
                                <input type="text" class="form-control" name="spec_name" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="safe_password" value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" onclick="spec_add()">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{--添加规格类--}}

{{--添加子规格--}}
<div class="modal fade" id="myModal_Spec_Item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
{{--添加子规格--}}


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>


{{--确认删除--}}
{{--<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>--}}
{{--确认删除--}}


{{--上传图片--}}
<div class="modal fade" id="myModal_thumb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" role="form" id="uploadForm" method="post" enctype="multipart/form-data" action="">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <input type="hidden" name="goods_id" id="goods_id" value="{{$goods->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">上传图片</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">图片信息</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle" style="display: none;" name="upload_thumb" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button type="button" class="btn btn-success" onclick="return uploadForm();">上传图片</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{--上传图片--}}

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
    //规格添加
    function addSpec() {
        $('#myModal_Spec').modal();
    }

    //弹出上传图片窗口
    function addthumb() {
        $('#myModal_thumb').modal();
    }

    //编辑提交表单
    function postEditForm() {
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
                    confirmButtonText: "确定"
                });
            }
        });
    }

    //添加规格类提交
    function spec_add() {
        var target = $("#spec_add");
        var url = target.attr("action");
        var token = $('#_token').val();
        var goods_id = $('#goods_id').val();
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定"
                },function(){
                    //规格添加成功后异步刷新规格部分
                    $.ajax({
                        url:'{{url('retailbranch/ajax/goods_spec')}}',
                        data:{
                            _token:token,
                            goods_id:goods_id
                        },
                        type:'post',
                        success:function(data){
                            $("#spec_content").html(data);
                            $('#myModal_Spec').modal('hide');
                        },
                        error:function(){
                            alert('添加出错，请稍后再试！');
                        }
                    })
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定"
                });
            }
        });
    }

    //上传图片提交表单
    function uploadForm() {
        var formData = new FormData($( "#uploadForm" )[0]);
        $.ajax({
            url: '{{ url('retailbranch/ajax/upload_thumb_check') }}' ,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (json) {
                if (json.status == -1) {
                    window.location.reload();
                } else if(json.status == 1) {
                    swal({
                        title: "提示信息",
                        text: json.data,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定",
                    },function(){
                        //图片添加成功后异步刷新图片列表部分
                        var url = '{{url('retailbranch/ajax/goods_thumb')}}';//需要异步加载的页面
                        var goods_id = $("#goods_id").val();
                        var token = $("#_token").val();
                        var data = {'goods_id':goods_id,'_token':token};
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
                                $('#thumb_content').html(response);
                                $('#myModal_thumb').modal('hide');
                            }
                        });
                    });
                }else{
                    swal({
                        title: "提示信息",
                        text: json.data,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定"
                    });
                }
            },
            error: function (json) {
                console.log(json);
            }
        });
    }
</script>





</body>
</html>
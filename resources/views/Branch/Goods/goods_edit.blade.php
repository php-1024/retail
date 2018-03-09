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
    @include('Branch/Public/Header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('Branch/Public/Nav')
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
                                        <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('branch/ajax/goods_edit_check') }}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-id-1">商品分类</label>
                                                <div class="col-sm-8">
                                                    <select name="account" class="form-control m-b">
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
                                                    <button type="button" class="btn btn-success" onclick="return postForm();">保存信息</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade in" id="picture">
                                        <button type="button" class="btn btn-success" id="addBtnthumb"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加图片</button>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
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
                                                    <th>

                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m0.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image1.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="1" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m1.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image2.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="2" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m2.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image3.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="3" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m3.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image4.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="4" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m4.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image5.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="5" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m5.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image6.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="6" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('public/Branch')}}/images/m6.jpg" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>
                                                        http://mydomain.com/images/image7.png
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sort" size="3" value="7" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="line line-dashed b-b line-lg pull-in"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12 col-sm-offset-6">

                                                    <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade in" id="option">
                                        <button type="button" class="addBtn btn btn-info">添加规格&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="m-t">
                                            <label class="label label-primary">主食</label>
                                            <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                        </div>
                                        <div class="m-t">
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">米饭</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">拉面</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">餐包</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <button type="button" class="btn addBtn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加规格子项</button>
                                            </div>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="m-t">
                                            <label class="label label-primary">味道</label>
                                            <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                        </div>
                                        <div class="m-t">
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">酸</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">甜</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">苦</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <label class="label label-success">辣</label>
                                                <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="m-t col-lg-2">
                                                <button type="button" class="btn addBtn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加规格子项</button>
                                            </div>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
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


<div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        $(".addBtnthumb").click(function(){
            $('#myModal8').modal();
        });
        $(".deleteBtn").click(function(){
            $('#myModal1').modal();
        });
        $(".editBtn").click(function(){
            $('#myModal2').modal();
        });
        $('#editBtn').click(function(){
            $('#myModal').modal();
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
                    window.location.href = "{{asset("branch/goods/goods_list")}}";
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
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
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/nestable/nestable.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Catering')}}/js/chosen/chosen.css" type="text/css" />
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
                                    <a href="{{url('catering/menu/menu_customize')}}" class="list-group-item active">
                                        自定义菜单
                                    </a>
                                    <a href="{{url('catering/menu/menu_different')}}" class="list-group-item">
                                        个性化菜单
                                    </a>

                                </div>
                            </section>
                        </section>
                    </aside>
                    <!-- / side content -->
                    <section>
                        <section class="vbox">
                            <section class="scrollable padder-lg">
                                <h2 class="font-thin m-b">自定义菜单</h2>
                                <div class="col-sm-4">
                                    <div class="dd" id="nestable1">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                          <span class="pull-right">
                                            <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                          </span>
                                                    主菜单1
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                          <span class="pull-right">
                                            <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                          </span>
                                                    主菜单2
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                          <span class="pull-right">
                                            <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                          </span>
                                                    主菜单3
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                  <span class="pull-right">
                                                    <button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                                    <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                                                  </span>
                                                            子菜单1
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>

                                    </div>
                                </div>
                                <div class="col-sm-8">

                                    <section class="panel panel-default">
                                        <header class="panel-heading font-bold">
                                            自定义菜单设置
                                        </header>
                                        <div class="panel-body">
                                            <form class="form-horizontal" method="get">

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">上级菜单</label>
                                                    <div class="col-sm-10">
                                                        <select name="account" class="form-control m-b">
                                                            <option>无</option>
                                                            <option>option 2</option>
                                                            <option>option 3</option>
                                                            <option>option 4</option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">菜单名称</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="input-id-1" value="测试菜单1">
                                                    </div>
                                                </div>

                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">事件类型</label>
                                                    <div class="col-sm-10">
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-sm btn-info active" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options" checked=""><i class="fa fa-check text-active"></i> 链接
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options" checked=""><i class="fa fa-check text-active"></i> 模拟关键字
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options"><i class="fa fa-check text-active"></i> 扫码
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options"><i class="fa fa-check text-active"></i> 扫码(带等待信息)
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options"><i class="fa fa-check text-active"></i> 拍照发图
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;"">
                                                            <input type="radio" name="options"><i class="fa fa-check text-active"></i> 拍照或者相册发图
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options"><i class="fa fa-check text-active"></i> 微信相册发图
                                                            </label>

                                                            <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;">
                                                                <input type="radio" name="options"><i class="fa fa-check text-active"></i> 地理位置
                                                            </label>
                                                        </div>
                                                        <span class="help-block m-b-none">
                                            <p class="text-danger">事件类型为"链接"时，响应类型必须为跳转链接</p>
                                        </span>
                                                    </div>
                                                </div>

                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">响应类型</label>
                                                    <div class="col-sm-10">
                                                        <section class="panel panel-default">
                                                            <header class="panel-heading text-right bg-light">
                                                                <ul class="nav nav-tabs pull-left">
                                                                    <li class="active"><a href="#link_response" data-toggle="tab"><i class="fa fa-file-text-o text-muted"></i>&nbsp;&nbsp;跳转链接</a></li>
                                                                    <li><a href="#text_response" data-toggle="tab"><i class="icon icon-picture text-muted"></i>&nbsp;&nbsp;关键字回复</a></li>
                                                                </ul>
                                                                <span class="hidden-sm">&nbsp;</span>
                                                            </header>
                                                            <div class="panel-body">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade in active" id="link_response">
                                                                        <input type="text" class="form-control" id="input-id-1" value="" placeholder="跳转链接">
                                                                        <span class="help-block m-b-none">
                                                        <p>指定点击此菜单时要跳转的链接（注：链接需加http://）</p>
                                                    </span>
                                                                    </div>
                                                                    <div class="tab-pane fade in" id="text_response">
                                                                        <select style="width:260px" class="chosen-select2">
                                                                            <option value="AK">请选择关键字</option>
                                                                            <option value="HI">关键字1</option>
                                                                            <option value="HI">关键字2</option>
                                                                            <option value="HI">关键字3</option>
                                                                        </select>
                                                                        <span class="help-block m-b-none">
                                                        <p>指定点击此菜单时要执行的操作, 你可以在这里输入关键字, 那么点击这个菜单时就就相当于发送这个内容至公众号</p>
                                                        <p>这个过程是程序模拟的, 比如这里添加关键字: 优惠券, 那么点击这个菜单是, 相当于接受了粉丝用户的消息, 内容为"优惠券"</p>
                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>

                                                <div class="line line-dashed b-b line-lg pull-in"></div>

                                                <div class="form-group">
                                                    <div class="col-sm-12 col-sm-offset-3">
                                                        <button type="button" class="btn btn-success" id="addBtn">添加菜单</button>
                                                        <button type="button" class="btn btn-primary" id="addBtn">一键创建默认自定义菜单</button>
                                                        <button type="button" class="btn btn-dark" id="addBtn">一键同步到微信公众号</button>
                                                    </div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                            </form>
                                        </div>
                                    </section>
                                    <section class="panel panel-default">
                                        <header class="panel-heading font-bold">
                                            常用入口链接
                                        </header>
                                        <div class="panel-body">
                                            <form class="form-horizontal" method="get">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">点餐系统入口</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="input-id-1" disabled="" value="http://o2o.01nnt.com/diancan-11">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">外卖系统入口</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="input-id-1" disabled="" value="http://o2o.01nnt.com/diancan-12">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-id-1">预约系统入口</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="input-id-1" disabled="" value="http://o2o.01nnt.com/diancan-13">
                                                    </div>
                                                </div>
                                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                            </form>
                                        </div>
                                    </section>
                                </div>
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
<script src="{{asset('public/Catering')}}/js/nestable/jquery.nestable.js"></script>
<script src="{{asset('public/Catering')}}/js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/js/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Catering')}}/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
        $('.delete_btn').click(function(){
            $(this).parent().parent().parent().remove();
        });
        $('#nestable1').nestable();
        $('.chosen-select2').chosen({width:"100%"});
    });
</script>
</body>
</html>

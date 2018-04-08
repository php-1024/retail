<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>编辑运费模板 | 零壹云管理平台 | 零售版店铺管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css"/>
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet"/>
    <link href="{{asset('public/Branch')}}/library/wizard/css/custom.css" rel="stylesheet"/>
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch')}}/library/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    {{--头部--}}
    @include('Retail/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
        @include('Retail/Public/Nav')
        <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">运费模板列表</h3>
                        </div>
                        <div class="row wrapper">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-s-md btn-success" onclick="window.history.back()">
                                    返回上一级
                                </button>
                            </div>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                编辑运费模板
                            </header>
                            <div class="line line-border b-b pull-in"></div>
                            <div style="clear:both"></div>
                            <div class="col-sm-12">
                                <form method="post" class="form-horizontal" role="form" id="currentForm"
                                      action="http://o2o.01nnt.com/retail/ajax/goods_list">
                                    <input type="hidden" name="_token" value="gXrfjYLgVjSqVznCZOEWuDXxXCeIdWCEq4tuYcB6">
                                    <label class="col-sm-1 control-label">模板名称</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="全国包邮"
                                               name="goods_name">
                                    </div>
                                    <label class="col-sm-1 control-label">模板编号</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="152014521021"
                                               name="goods_name" readonly="readonly">
                                    </div>
                                </form>
                            </div>

                            <div style="clear:both"></div>
                            <div class="line line-border b-b pull-in"></div>
                            <form method="post" class="form-horizontal" role="form" id="purchase_goods"
                                  action="http://o2o.01nnt.com/retail/ajax/purchase_goods_check">
                                <div class="tab-pane">
                                    <div class="col-lg-5">
                                        <section class="panel panel-default">
                                            <header class="panel-heading font-bold">选择可配送区域</header>
                                            <table class="table table-striped table-bordered ">
                                                <thead>
                                                <tr>
                                                    <th>可选省、市</th>


                                                    <th></th>
                                                    <th>已选省、市</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody id="goods_list">
                                                <tr id="30">
                                                    <td class="id"><select name="from" id="multiselect"
                                                                           class="form-control"
                                                                           style="display: inline-block;" size="15"
                                                                           multiple="multiple">
                                                            <option value="10" data-position="163">添加战区（零壹平台管理系统）
                                                            </option>
                                                            <option value="9" data-position="164">战区管理（零壹平台管理系统）
                                                            </option>
                                                            <option value="4" data-position="165">测试节点4</option>
                                                            <option value="3" data-position="166">测试节点3</option>
                                                            <option value="2" data-position="167">测试节点2</option>
                                                            <option value="1" data-position="168">测试节点1</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="col-sm-2">
                                                            <button type="button" id="multiselect_rightAll"
                                                                    class="btn btn-s-md btn-block"><i
                                                                        class="icon-control-forward icons"></i></button>
                                                            <button type="button" id="multiselect_rightSelected"
                                                                    class="btn btn-s-md btn-block"><i
                                                                        class="icon-arrow-right icons"></i></button>
                                                            <button type="button" id="multiselect_leftSelected"
                                                                    class="btn btn-s-md btn-block"><i
                                                                        class="icon-arrow-left icons"></i></button>
                                                            <button type="button" id="multiselect_leftAll"
                                                                    class="btn btn-s-md btn-block"><i
                                                                        class="icon-control-rewind icons"></i></button>
                                                        </div>
                                                    </td>
                                                    <td class="name">
                                                        <select name="nodes[]" id="multiselect_to" class="form-control"
                                                                size="15" multiple="multiple"></select>

                                                    </td>


                                                    <td>
                                                        <button onclick="goodsSelect(30);" class="btn btn-info btn-xs"
                                                                type="button">
                                                            <i class="fa fa-plus"></i>添加选择
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div style="clear: both;"></div>
                                        </section>
                                    </div>

                                    <div class="col-lg-6">
                                        <section class="panel panel-default">
                                            <header class="panel-heading font-bold">配送区域：(选择可配送区域之前，请保存重量和价格参数)</header>
                                            <table class="table table-striped table-bordered ">
                                                <thead>
                                                <tr>
                                                    <th>配送区域</th>
                                                    <th>首重(克)</th>
                                                    <th>运费(元/千克)</th>
                                                    <th>续重(克)</th>
                                                    <th>续费(元/千克)</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody id="goods_list">
                                                <tr id="30">
                                                    <td class="id">
                                                        <label class="label label-success" style="display:inline-block">北京市</label>
                                                        <label class="label label-success" style="display:inline-block">河南省</label>
                                                        <label class="label label-success" style="display:inline-block">湖北省</label>
                                                        <label class="label label-success" style="display:inline-block">湖南省</label>
                                                    </td>
                                                    <td class="name"><input type="text" name="firstweight175"
                                                                            id="firstweight175" value="0"
                                                                            class="input-sm form-control"></td>
                                                    <td class="price"><input type="text" name="firstprice175"
                                                                             id="firstprice175" value="0.00"
                                                                             class="input-sm form-control"></td>
                                                    <td class="price"><input type="text" name="secondweight175"
                                                                             id="secondweight175" value="0"
                                                                             class="input-sm form-control"></td>
                                                    <td class="price"><input type="text" name="secondprice175"
                                                                             id="secondprice175" value="0.00"
                                                                             class="input-sm form-control"></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-xs"
                                                                onclick="javascript:cancel_detail(175)"><i
                                                                    class="fa fa-times"></i>&nbsp;&nbsp;删除
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div style="clear: both;"></div>
                                        </section>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <footer class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-sm-offset-6">
                                            <button type="button" class="btn btn-success" onclick="PostForm('1')">确认提交
                                            </button>
                                        </div>
                                    </div>
                                </footer>
                            </form>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/library/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch')}}/library/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript"
        src="{{asset('public/Branch')}}/library/wizard/js/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript">
    $(function(){
        //设置CSRF令牌
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#multiselect').multiselect({keepRenderingSort:true});
    });
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var module_name = $('#module_name').val();
        var module_show_name = $('#module_show_name').val();
        var _token = $('#_token').val();
        var node = '';
        $('#multiselect_to option').each(function(i,v){
            node += 'nodes[]='+$(v).val()+'&';
        });
        node = node.substring(0, node.length-1);
        var data = '_token='+_token+'&module_name='+module_name+'&module_show_name='+module_show_name+'&'+node;
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
                    window.location.reload();
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
</script>
</body>
</html>
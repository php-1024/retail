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
                                        <input class="input-sm form-control" size="16" type="text" value="全国包邮" name="goods_name">
                                    </div>
                                    <label class="col-sm-1 control-label">模板编号</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="152014521021" name="goods_name" readonly="readonly">
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




                                                    <th>已选省、市</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody id="goods_list">
                                                <tr id="30">
                                                    <td class="id">

                                                        <ul>
                                                            <li id="beijin">北京市<button><a href="javascript:add('beijin')">添加</a></button></li>
                                                            <li id="tianjin">天津市<button><a href="javascript:add('tianjin')">添加</a></button></li>
                                                            <li id="hebei">河北省<button><a href="javascript:add('hebei')">添加</a></button></li>
                                                            <li id="shan_xi">山西省<button><a href="javascript:add('shan_xi')">添加</a></button></li>
                                                            <li id="neimenggu">内蒙古区<button><a href="javascript:add('neimenggu')">添加</a></button></li>
                                                            <li id="liaoning">辽宁省<button><a href="javascript:add('liaoning')">添加</a></button></li>
                                                            <li id="jilin">吉林省<button><a href="javascript:add('jilin')">添加</a></button></li>
                                                            <li id="heilongjiang">黑龙江省<button><a href="javascript:add('heilongjiang')">添加</a></button></li>
                                                            <li id="shanghai">上海市<button><a href="javascript:add('shanghai')">添加</a></button></li>
                                                            <li id="jiangsu">江苏省<button><a href="javascript:add('jiangsu')">添加</a></button></li>
                                                            <li id="zhejiang">浙江省<button><a href="javascript:add('zhejiang')">添加</a></button></li>
                                                            <li id="anhui">安徽省<button><a href="javascript:add('anhui')">添加</a></button></li>
                                                            <li id="fujian">福建省<button><a href="javascript:add('fujian')">添加</a></button></li>
                                                            <li id="jiangxi">江西省<button><a href="javascript:add('jiangxi')">添加</a></button></li>
                                                            <li id="shandong">山东省<button><a href="javascript:add('shandong')">添加</a></button></li>
                                                            <li id="henan">河南省<button><a href="javascript:add('henan')">添加</a></button></li>
                                                            <li id="hubei">湖北省<button><a href="javascript:add('hubei')">添加</a></button></li>
                                                            <li id="hunan">湖南省<button><a href="javascript:add('hunan')">添加</a></button></li>
                                                            <li id="guangdong">广东省<button><a href="javascript:add('guangdong')">添加</a></button></li>
                                                            <li id="guangxi">广西区<button><a href="javascript:add('guangxi')">添加</a></button></li>
                                                            <li id="hainan">海南省<button><a href="javascript:add('hainan')">添加</a></button></li>
                                                            <li id="chongqing">重庆市<button><a href="javascript:add('chongqing')">添加</a></button></li>
                                                            <li id="sichuan">四川省<button><a href="javascript:add('sichuan')">添加</a></button></li>
                                                            <li id="guizhou">贵州省<button><a href="javascript:add('guizhou')">添加</a></button></li>
                                                            <li id="yunnan">云南省<button><a href="javascript:add('yunnan')">添加</a></button></li>
                                                            <li id="xizang">西藏区<button><a href="javascript:add('xizang')">添加</a></button></li>
                                                            <li id="shanxi">陕西省<button><a href="javascript:add('shanxi')">添加</a></button></li>
                                                            <li id="gansu">甘肃省<button><a href="javascript:add('gansu')">添加</a></button></li>
                                                            <li id="qinghai">青海省<button><a href="javascript:add('qinghai')">添加</a></button></li>
                                                            <li id="ningxia">宁夏区<button><a href="javascript:add('ningxia')">添加</a></button></li>
                                                            <li id="xinjiang">新疆区<button><a href="javascript:add('xinjiang')">添加</a></button></li>
                                                            <li id="taiwan">台湾省<button><a href="javascript:add('taiwan')">添加</a></button></li>
                                                            <li id="xianggang">香港特区<button><a href="javascript:add('xianggang')">添加</a></button></li>
                                                            <li id="aomeng">澳门特区<button><a href="javascript:add('aomeng')">添加</a></button></li>

                                                        </ul>






                                                    </td>
                                                    <td class="name">
                                                        <select name="nodes[]" id="multiselect_to" class="form-control" size="15" multiple="multiple"><option value="175" data-position="2">零售管理系统（修改店铺信息提交）</option><option value="172" data-position="3">零售管理系统（微信支付设置）</option><option value="171" data-position="4">零售管理系统（冻结粉丝提交）</option><option value="170" data-position="5">零售管理系统（冻结粉丝弹窗）</option><option value="169" data-position="6">零售管理系统（粉丝钱包）</option><option value="168" data-position="7">零售管理系统（粉丝信息修改提交）</option></select>
                                                    </td>



                                                    <td>
                                                        <button onclick="goodsSelect(30);" class="btn btn-info btn-xs" type="button">
                                                            <i class="fa fa-plus"></i>添加选择</button>
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
                                                    <td class="name"><input type="text" name="firstweight175" id="firstweight175" value="0" class="input-sm form-control"></td>
                                                    <td class="price"><input type="text" name="firstprice175" id="firstprice175" value="0.00" class="input-sm form-control"></td>
                                                    <td class="price"><input type="text" name="secondweight175" id="secondweight175" value="0" class="input-sm form-control"></td>
                                                    <td class="price"><input type="text" name="secondprice175" id="secondprice175" value="0.00" class="input-sm form-control"></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-xs" onclick="javascript:cancel_detail(175)"><i class="fa fa-times"></i>&nbsp;&nbsp;删除
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true"></div>
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


    //订单详情
    function getwalletForm(id, type) {
        var url = $('#order_list_details').val();
        var token = $('#_token').val();
        var data = {'_token': token, 'id': id, 'type': type};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }


    //审核订单
    function getlockForm(id, status) {
        var url = $('#purchase_list_confirm').val();
        var token = $('#_token').val();
        var data = {'_token': token, 'id': id, 'status': status};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定"
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                console.log(response);
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }

    //添加会员标签
    function getEditForm(id) {
        var url = $('#user_list_edit').val();
        var token = $('#_token').val();
        var data = {'_token': token, 'id': id};
        $.post(url, data, function (response) {
            if (response.status == '-1') {
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
                return;
            } else {
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }

    function changeUserTag(obj, user_id, store_id, nickname) {
        var label_id = $(obj).val();
        var url = $('#store_label_add_check').val();
        var token = $('#_token').val();
        var data = {
            '_token': token,
            'label_id': label_id,
            'user_id': user_id,
            'store_id': store_id,
            'nickname': nickname
        };
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if (json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                }, function () {
                    window.location.reload();
                });
            } else {
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
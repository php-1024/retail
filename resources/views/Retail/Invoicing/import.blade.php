<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>零壹云管理平台 | 零售版店铺管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css"/>
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet"/>
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
                            <h3 class="m-b-none">进出开单</h3>
                        </div>

                        <section class="panel panel-default">
                            <header class="panel-heading">
                                进出开单
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-s-md btn-success">供应商到货开单</button>
                                        <button type="button" class="btn btn-s-md btn">&nbsp;&nbsp;退供应商货开单</button>
                                        <button type="button" class="btn btn-s-md btn">&nbsp;&nbsp;报损开单</button>
                                        <button type="button" class="btn btn-s-md btn">&nbsp;&nbsp;盘点开单</button>
                                    </div>
                                </form>
                            </div>

                            <div class="line line-border b-b pull-in"></div>

                            <div class="col-sm-12">
                                <form class="form-horizontal" method="get">


                                    <label class="col-sm-1 control-label">用户账号</label>

                                    <div class="col-sm-1">
                                        <input class="input-sm form-control" size="16" type="text" value="">
                                    </div>
                                    <label class="col-sm-1 control-label">订单编号</label>

                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="">
                                    </div>
                                    <div class="col-sm-1">
                                        <select name="account" class="form-control m-b">
                                            <option>支付方式</option>
                                            <option>在线余额支付</option>
                                            <option>在线支付</option>
                                            <option>003</option>
                                            <option>004</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <select name="account" class="form-control m-b">
                                            <option>订单状态</option>
                                            <option>未支付</option>
                                            <option>已支付</option>
                                            <option>已完成</option>
                                            <option>已取消</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-1">

                                        <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索
                                        </button>
                                    </div>
                                </form>
                            </div>


                            <div style="clear:both"></div>
                            <div class="line line-border b-b pull-in"></div>
                            <div class="tab-pane">

                                <div class="col-lg-7">
                                    <section class="panel panel-default">
                                        <header class="panel-heading font-bold">
                                            选择商品
                                        </header>

                                        <table class="table table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>商品标题</th>
                                                <th>商品价格</th>
                                                <th>库存</th>

                                                <th>规格</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>奇味鸡煲</td>
                                                <td>
                                                    100000.00
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    <select name="account" class="form-control m-b">
                                                        <option>无</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" id="editBtn" type="button"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>奇味鸡煲</td>
                                                <td>
                                                    100000.00
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    <select name="account" class="form-control m-b">
                                                        <option>无</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" id="editBtn" type="button"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>奇味鸡煲</td>
                                                <td>
                                                    100000.00
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    <select name="account" class="form-control m-b">
                                                        <option>无</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" id="editBtn" type="button"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>奇味鸡煲</td>
                                                <td>
                                                    100000.00
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    <select name="account" class="form-control m-b">
                                                        <option>无</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" id="editBtn" type="button"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>奇味鸡煲</td>
                                                <td>
                                                    100000.00
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    <select name="account" class="form-control m-b">
                                                        <option>无</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" id="editBtn" type="button"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>奇味鸡煲</td>
                                                <td>
                                                    100000.00
                                                </td>
                                                <td>
                                                    999
                                                </td>
                                                <td>
                                                    <select name="account" class="form-control m-b">
                                                        <option>无</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" id="editBtn" type="button"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;选择
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

                                        <button type="button" class="btn btn-success" id="addBtn">确认提交</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>


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
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $('#editBtn').click(function () {
        $('#myModal').modal();
    });

    //编辑店铺信息
    function EditStore() {
        var formData = new FormData($("#store_edit")[0]);
        $.ajax({
            url: '{{ url('retail/ajax/store_edit_check') }}',
            type: 'post',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (json) {
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
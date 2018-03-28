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


                                    <label class="col-sm-1 control-label">供应商</label>

                                    <div class="col-sm-1">
                                        <input class="input-sm form-control" size="16" type="text" value=""
                                               placeholder="供应商id">
                                    </div>


                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value=""
                                               placeholder="公司名称或联系人姓名">
                                    </div>

                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value=""
                                               placeholder="联系人手机">
                                    </div>


                                    <div class="col-sm-1">

                                        <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索
                                        </button>
                                    </div>
                                </form>
                            </div>


                            <div style="clear:both"></div>
                            <div class="line line-border b-b pull-in"></div>

                            <div class="col-sm-12">
                                <form class="form-horizontal" method="get">


                                    <label class="col-sm-1 control-label">商&nbsp; &nbsp; &nbsp;品</label>


                                    <div class="col-sm-2">
                                        <select name="account" class="form-control m-b">
                                            <option value="0">请选择一级分类</option>
                                            <option value="5970">美妆</option>
                                            <option value="5974">面膜</option>
                                            <option value="5977">跨境</option>
                                            <option value="5963">护肤</option>
                                            <option value="6360">香水</option>
                                            <option value="5990">个护</option>
                                            <option value="5981">内衣</option>
                                            <option value="5985">养生</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value=""
                                               placeholder="关键字或条码">
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
                                                <th>商品ID</th>
                                                <th>商品标题</th>
                                                <th>商品价格</th>


                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id="1">
                                                <td class="id">1</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(1);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="2">
                                                <td class="id">2</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(2);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="3">
                                                <td class="id">3</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(3);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="4">
                                                <td class="id">4</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(4);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="5">
                                                <td class="id">5</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(5);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="6">
                                                <td class="id">6</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(6);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="7">
                                                <td class="id">7</td>
                                                <td class="name">性感女人香水</td>
                                                <td class="price">88.00</td>
                                                <td>
                                                    <button onclick="goodsSelect(7);" class="btn btn-info btn-xs" type="button">
                                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div style="clear: both;"></div>
                                    </section>
                                </div>

                                <div class="col-lg-5">
                                    <section class="panel panel-default">
                                        <header class="panel-heading font-bold">
                                            开单商品列表 操作人员：刘新文
                                        </header>
                                        <div class="panel-body">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>商品ID</th>
                                                    <th>商品标题</th>
                                                    <th>商品价格</th>


                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr id="hs1_0">
                                                    <td>1</td>
                                                    <td>性感女人香水</td>
                                                    <td>
                                                        88.00
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs" onclick="goodsSub(1,0)"><i class="fa fa-minus"></i></button>
                                                        <input type="text" id="input1_0" onchange="update_num(1,0)" class="text-center" value="1000" size="4">
                                                        <button type="button" class="btn btn-success btn-xs" onclick="goodsAdd(1,0)"><i class="fa fa-plus"></i></button>
                                                        <button type="button" class="btn btn-danger btn-xs" onclick="goodsCancel(4461,0)">删除</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
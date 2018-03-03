<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 分店业务系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Branch')}}/library/wizard/css/custom.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch')}}/library/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    {{--头部--}}
    @include('Branch/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('Branch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">收银台</h3>
                        </div>
                        <section class="panel">
                            <div class="panel-body">
                                <form method="get" class="form-horizontal">
                                    <div id="rootwizard">
                                        <ul class="bwizard-steps">
                                            <li class="active"><a href="#tab1" data-toggle="tab"><span style="color:#999;" class="label">1</span> 选择顾客 </a></li>
                                            <li class=""><a href="#tab2" data-toggle="tab"><span style="color:#999;" class="label">2</span> 选择餐桌</a></li>
                                            <li class=""><a href="#tab3" data-toggle="tab"><span style="color:#999;" class="label">3</span> 点餐</a></li>
                                        </ul>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <section class="panel panel-default">
                                                    <header class="panel-heading">
                                                        现场顾客列表
                                                    </header>
                                                    <div class="row wrapper">
                                                        <form class="form-horizontal" method="get">
                                                            <label class="col-sm-1 control-label">用户账号</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" class="form-control" id="input-id-1" value="" placeholder="用户账号">
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type="button" class="btn btn-s-md btn-info"><i class="icon icon-magnifier"></i>&nbsp;&nbsp;搜索</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped b-t b-light">
                                                            <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>微信头像</th>
                                                                <th>用户账号</th>
                                                                <th>微信昵称</th>
                                                                <th>手机号</th>
                                                                <th>状态</th>
                                                                <th>进店时间</th>
                                                                <th>操作</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><img src="{{asset('public/Branch/images/m1.jpg')}}" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                                                <td>100020</td>
                                                                <td>时光取名叫无心</td>
                                                                <td>13123456789</td>
                                                                <td>
                                                                    <label class="label label-warning">就餐中</label>
                                                                </td>
                                                                <td>2017-10-22 10:11:11</td>
                                                                <td>
                                                                    <button class="btn btn-success btn-xs selected_btn" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td><img src="{{asset('public/Branch/images/m1.jpg')}}" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                                                <td>100020</td>
                                                                <td>时光取名叫无心</td>
                                                                <td>13123456789</td>
                                                                <td>
                                                                    <label class="label label-success">刚刚进店</label>
                                                                </td>
                                                                <td>2017-10-22 10:11:11</td>
                                                                <td>
                                                                    <button class="btn btn-info btn-xs selected_btn" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td><img src="{{asset('public/Branch/images/m1.jpg')}}" alt="" class="r r-2x img-full" style="width: 50px; height: 50px;"></td>
                                                                <td>100020</td>
                                                                <td>时光取名叫无心</td>
                                                                <td>13123456789</td>
                                                                <td>
                                                                    <label class="label label-warning">就餐中</label>
                                                                </td>
                                                                <td>2017-10-22 10:11:11</td>
                                                                <td>
                                                                    <div class="btn-group" data-toggle="buttons">
                                                                        <button class="btn btn-info btn-xs selected_btn"  type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <section class="panel panel-default">
                                                    <header class="panel-heading bg-light">
                                                        <ul class="nav nav-tabs nav-justified">
                                                            <li class="active"><a href="#home" data-toggle="tab">大厅</a></li>
                                                            <li><a href="#profile" data-toggle="tab">包厢1</a></li>
                                                            <li><a href="#messages" data-toggle="tab">包厢2</a></li>
                                                            <li><a href="#settings" data-toggle="tab">包厢3</a></li>

                                                        </ul>
                                                    </header>
                                                    <div class="panel-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="home">
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-success btn-rounded selected_table ">001</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">002</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">003</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">004</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">005</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">006</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">007</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">008</button>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="profile">
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-success btn-rounded selected_table ">001</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">002</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">003</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">004</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">005</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">006</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">007</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">008</button>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="messages">
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-success btn-rounded selected_table ">001</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">002</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">003</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">004</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">005</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">006</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">007</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">008</button>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="settings">
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-success btn-rounded selected_table ">001</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">002</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">003</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">004</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">005</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">006</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">007</button>
                                                                </div>
                                                                <div class="col-lg-2 m-t">
                                                                    <button type="button" class="btn btn-s-md btn-lg btn-info btn-rounded selected_table  ">008</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>


                                            </div>
                                            <div class="tab-pane" id="tab3">

                                                <div class="col-lg-7">
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading font-bold">
                                                            选择商品
                                                        </header>
                                                        <div class="tabs-container">

                                                            <div class="tabs-left">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tab6" aria-expanded="true">主食</a></li>
                                                                    <li class=""><a data-toggle="tab" href="tab7" aria-expanded="false">凉菜</a></li>
                                                                    <li class=""><a data-toggle="tab" href="tab8" aria-expanded="false">小菜</a></li>
                                                                    <li class=""><a data-toggle="tab" href="tab8" aria-expanded="false">炒菜</a></li>
                                                                    <li class=""><a data-toggle="tab" href="tab9" aria-expanded="false">饮料酒水</a></li>
                                                                </ul>

                                                                <div class="tab-content ">
                                                                    <div id="tab6" class="tab-pane active">
                                                                        <div class="panel-body">
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
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
                                                                                        <button class="btn btn-info btn-xs" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
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
                                                                                        <button class="btn btn-info btn-xs" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div id="tab7" class="tab-pane">
                                                                        <section class="panel panel-default">
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
                                                                                    <td>拍黄瓜</td>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>2</td>
                                                                                    <td>拍黄瓜</td>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>3</td>
                                                                                    <td>拍黄瓜</td>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>4</td>
                                                                                    <td>拍黄瓜</td>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>5</td>
                                                                                    <td>拍黄瓜</td>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>1</td>
                                                                                    <td>拍黄瓜</td>
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
                                                                                        <button class="btn btn-info btn-xs"  type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;选择</button>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </section>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div style="clear: both;"></div>
                                                    </section>
                                                </div>
                                                <div class="col-lg-5">
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading font-bold">
                                                            购物车 刘新文 003号桌 12人
                                                        </header>
                                                        <div class="panel-body">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>商品标题</th>
                                                                    <th>数量</th>
                                                                    <th>规格</th>
                                                                    <th>商品价格</th>
                                                                    <th>操作</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>奇味鸡煲</td>
                                                                    <td>
                                                                        10
                                                                    </td>
                                                                    <td>
                                                                        米饭 + 辣
                                                                    </td>
                                                                    <td>
                                                                        100000.00
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-plus"></i></button>
                                                                        <input type="text"  id="exampleInputPassword2" class="text-center" value="1000" size="4">
                                                                        <button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-minus"></i></button>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><label class="label label-info">商品总计</label></td>
                                                                    <td>
                                                                        <label class="label label-danger">&yen;100000.00</label>
                                                                    </td>
                                                                    <td><label class="label label-danger">10份</label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><label class="label label-info">餐位费</label></td>
                                                                    <td>
                                                                        <label class="label label-danger">&yen;12.00</label>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><label class="label label-info">总计</label></td>
                                                                    <td>
                                                                        <label class="label label-danger">&yen;100012.00</label>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </section>
                                                </div>
                                                <div style="clear: both;"></div>
                                            </div>


                                        </div>
                                        <ul class="pager wizard">

                                            <li class="previous"><button type="button" class="btn btn-success"><i class="icon-arrow-left"></i>&nbsp;&nbsp;上一步</button></li>

                                            <li class="next disabled hidden"><button type="button" class="btn btn-success">下一步&nbsp;&nbsp;<i class="icon-arrow-right"></i></button></li>
                                            <li class="finish"><button type="button" id="addBtn" class="btn btn-success">完成&nbsp;&nbsp;<i class="icon-arrow-right"></i></button></li>
                                        </ul>
                                    </div>
                                </form>
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
                    <h4 class="modal-title">店铺信息编辑</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 text-right">分店名称</label>
                            <div class="col-sm-10">
                                <input type="text" value="刘记鸡煲王【龙岗店】" placeholder="店铺名称" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-sm-2 text-right">负责人</label>
                            <div class="col-sm-10">
                                <input type="text" value="张老三" placeholder="负责人" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">手机号码</label>
                            <div class="col-sm-10">
                                <input type="text" value="13123456789" placeholder="手机号码" class="form-control">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">店铺LOGO</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                            </div>
                        </div>

                        <div style="clear:both;"></div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 text-right">店铺地址</label>
                            <div class="col-sm-10">
                                <input type="text" value="广东省深圳市龙岗区万汇大厦1606" placeholder="店铺地址" class="form-control">
                            </div>
                        </div>

                        <div style="clear:both;"></div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

                        <div class="form-group">
                            <label class="col-sm-2 text-right">安全密码</label>
                            <div class="col-sm-10">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                            </div>
                        </div>
                        <div style="clear:both;"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="save_btn">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script type="text/javascript" src="{{asset('public/Branch')}}/library/wizard/js/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});
        $('.selected_btn').click(function(){
            $('.selected_btn').removeClass('btn-success').addClass('btn-info');
            $(this).addClass('btn-success').removeClass('btn-info');
        });
        $('.selected_table').click(function(){
            $('.selected_table').removeClass('btn-success').addClass('btn-info');
            $(this).addClass('btn-success').removeClass('btn-info');
        });
    });
</script>
</body>
</html>
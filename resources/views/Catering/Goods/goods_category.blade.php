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
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">商品分类查询</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                商品分类列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <div class="col-sm-2">
                                        <select name="branch_id" class="form-control m-b">
                                            <option value="0">所有分店</option>
                                            @foreach($listBranch as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->organization_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-1 control-label">分类名称</label>

                                    <div class="col-sm-2">
                                        <input class="input-sm form-control" size="16" type="text" value="" name="category_name">
                                    </div>

                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                                </form>



                                {{--<form method="get" role="form" id="searchForm" action="" onsubmit="return searchFormCheck();">--}}
                                    {{--<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label class="control-label" for="date_added">操作时间</label>--}}
                                                {{--<div class="input-group date">--}}
                                                    {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="time_st" class="form-control zerodate" value="{{$search_data['time_st']}}" placeholder="请选择日期">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label class="control-label" for="date_modified">到</label>--}}
                                                {{--<div class="input-group date">--}}
                                                    {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="time_nd" class="form-control zerodate"  value="{{$search_data['time_nd']}}"  placeholder="请选择日期">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label class="control-label">操作账号</label>--}}
                                                {{--<input type="text" class="form-control" name="account" value="{{$search_data['account']}}" placeholder="请输入操作人账号">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label class="control-label" for="amount"> &nbsp;</label>--}}
                                                {{--<button type="submit" class="block btn btn-info"><i class="fa fa-search"></i>搜索</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}












                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>分类名称</th>
                                        <th>隶属分店</th>
                                        <th>添加时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $key=>$value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            <label class="label label-primary">{{$value->Organization->organization_name}}</label>
                                        </td>
                                        <td>{{$value->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">

                                    <div class="col-sm-12 text-right text-center-xs">
                                       {{$list->links()}}
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#editBtn').click(function(){
            $('#myModal').modal();
        });
        $('#save_btn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
</script>
</body>
</html>

























<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 总分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Retail')}}/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Retail')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Retail')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Retail')}}/js/ie/html5shiv.js"></script>
    <script src="{{asset('public/Retail')}}/js/ie/respond.min.js"></script>
    <script src="{{asset('public/Retail')}}/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        @include('Retail/Public/Header')
    </header>
    <section>
        <section class="hbox stretch">

            <!-- .aside -->
            <aside class="bg-black dk aside hidden-print" id="nav">
                <section class="vbox">
                    <section class="w-f-md scrollable">
                        @include('Retail/Public/Nav')
                    </section>
                </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">总分店管理</h3>
                        </div>
                        @foreach($listBranch as $key=>$value)
                        <div class="col-sm-2">
                            <section class="panel panel-default"   style="height: 280px;">
                                <header class="panel-heading bg-light no-border">
                                    <div class="clearfix">
                                        <a href="#" class="pull-left thumb-md avatar b-3x m-r">
                                        </a>
                                        <div class="clear">
                                            <div class=" m-t-xs m-b-xs">
                                                {{$value->organization_name}}
                                                <i class="fa fa-cutlery text-success text-lg pull-right"></i>
                                            </div>

                                        </div>
                                    </div>
                                </header>
                                <div class="panel-body ">
                                    <div>
                                        分店类型：<label class="label label-success pull-right">
                                            @if($value->organizationBranchinfo->type == '0')
                                                总店
                                            @else
                                                分店
                                            @endif
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div>
                                        分店状态：
                                            @if($value->status == '1')
                                                <label class="label label-success pull-right">正常 </label>
                                            @else
                                                <label class="label label-warning pull-right">冻结 </label>
                                            @endif

                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div>
                                        分店主账号：<label class="label label-info pull-right">{{$value->account->account}}</label>
                                    </div>

                                </div>
                                <div class="panel-body" style="text-align:center;">
                                    <button class="btn btn-s-md btn-danger">
                                        @if($value->organizationBranchinfo->type == '0')
                                            进入总店
                                        @else
                                            进入分店
                                        @endif
                                    </button>
                                </div>
                            </section>
                        </div>
                        @endforeach
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<script src="{{asset('public/Retail')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Retail')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Retail')}}/js/app.js"></script>
<script src="{{asset('public/Retail')}}/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Retail')}}/js/app.plugin.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/js/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Retail')}}/sweetalert/sweetalert.min.js"></script>


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

























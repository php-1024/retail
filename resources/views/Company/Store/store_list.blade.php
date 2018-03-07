<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>店铺列表 | 零壹云管理平台 | 商户管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Company/library/jPlayer')}}/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/app.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css">
    <link rel="stylesheet" href="{{asset('public/Company/library/datepicker')}}/datepicker.css">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Company/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/respond.min.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    @include('Company/Public/Header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
        @include('Company/Public/Nav')
        <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">管理店铺</h3>
                        </div>
                        @foreach($organization as $key=>$val)
                        <div class="col-sm-2">
                            <section class="panel panel-default"   style="height: 230px;">
                                <header class="panel-heading bg-light no-border">
                                    <div class="clearfix">
                                        <a href="#" class="pull-left thumb-md avatar b-3x m-r">
                                        </a>
                                        <div class="clear">
                                            <div class=" m-t-xs m-b-xs">
                                                {{$val->organization_name}}
                                                <i class="fa fa-cutlery text-success text-lg pull-right"></i>
                                            </div>

                                        </div>
                                    </div>
                                </header>
                                <div class="panel-body ">
                                    <div>
                                        店铺状态：<label class="label label-success pull-right">
                                            @if($val->status == 1)
                                            正常
                                            @else
                                            已冻结
                                            @endif
                                        </label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div>
                                        主账号：<label class="label label-info pull-right">
                                            @if(empty($val->account))
                                            {{--{{$val->account->account}}--}}
                                                无
                                            @else
                                                {{$val->account->account}}
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="panel-body" style="text-align:center;">
                                    <button class="btn btn-s-md btn-danger">进入店铺</button>
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
<script src="{{asset('public/Company')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Company')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Company')}}/js/app.js"></script>
<script src="{{asset('public/Company/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Company')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Company/library/jPlayer')}}/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Company/library/jPlayer')}}/add-on/jplayer.playlist.min.js"></script>
</body>
</html>
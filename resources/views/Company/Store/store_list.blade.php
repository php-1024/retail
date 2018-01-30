<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>零壹云管理平台 | 商户管理系统</title>
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
                            <h3 class="m-b-none">创建店铺</h3>
                        </div>
                        <div class="col-sm-2">
                            <section class="panel panel-default"   style="height: 230px;">
                                <header class="panel-heading bg-light no-border">
                                    <div class="clearfix">
                                        <a href="#" class="pull-left thumb-md avatar b-3x m-r">

                                        </a>
                                        <div class="clear">
                                            <div class=" m-t-xs m-b-xs">
                                                韦小堡
                                                <i class="fa fa-cutlery text-success text-lg pull-right"></i>
                                            </div>

                                        </div>
                                    </div>
                                </header>
                                <div class="panel-body ">

                                    <div>
                                        店铺状态：<label class="label label-success pull-right">正常</label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div>
                                        主账号：<label class="label label-info pull-right">503020</label>
                                    </div>

                                </div>
                                <div class="panel-body" style="text-align:center;">
                                    <button class="btn btn-s-md btn-danger">进入店铺</button>
                                </div>
                            </section>
                        </div>
                        <div class="col-sm-2">
                            <section class="panel panel-default"   style="height: 230px;">
                                <header class="panel-heading bg-light no-border">
                                    <div class="clearfix">
                                        <a href="#" class="pull-left thumb-md avatar b-3x m-r">

                                        </a>
                                        <div class="clear">
                                            <div class=" m-t-xs m-b-xs">
                                                楼兰美妆
                                                <i class="fa icon-basket-loaded text-success text-lg pull-right"></i>
                                            </div>

                                        </div>
                                    </div>
                                </header>
                                <div class="panel-body ">

                                    <div>
                                        店铺状态：<label class="label label-success pull-right">正常</label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div>
                                        主账号：<label class="label label-info pull-right">203020</label>
                                    </div>

                                </div>
                                <div class="panel-body" style="text-align:center;">
                                    <button class="btn btn-s-md btn-danger">进入店铺</button>
                                </div>
                            </section>
                        </div>
                        <div class="col-sm-2">
                            <section class="panel panel-default"   style="height: 230px;">
                                <header class="panel-heading bg-light no-border">
                                    <div class="clearfix">
                                        <a href="#" class="pull-left thumb-md avatar b-3x m-r">

                                        </a>
                                        <div class="clear">
                                            <div class=" m-t-xs m-b-xs">
                                                维也纳酒店
                                                <i class="fa fa-building-o text-success text-lg pull-right"></i>
                                            </div>

                                        </div>
                                    </div>
                                </header>
                                <div class="panel-body ">

                                    <div>
                                        店铺状态：<label class="label label-success pull-right">正常</label>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div>
                                        主账号：<label class="label label-info pull-right">303020</label>
                                    </div>

                                </div>
                                <div class="panel-body" style="text-align:center;">
                                    <button class="btn btn-s-md btn-danger">进入店铺</button>
                                </div>
                            </section>
                        </div>
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
<script src="{{asset('public/Company/library/sweetalert')}}/sweetalert.min.js"></script>
<script src="{{asset('public/Company/library/datepicker')}}/bootstrap-datepicker.js"></script>
<script>
    $(function(){
        $('.zerodate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    });
    function searchFormCheck(){
        var url = $('#searchForm').attr('action');
        var data = $('#searchForm').serialize();
        $.get(url+'?'+data,function(json){
            if(json.status==0){
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                });
                return false;
            }else{
                location.href=url+'?'+data;
            }
        });
        return false;
    }
</script>
</body>
</html>
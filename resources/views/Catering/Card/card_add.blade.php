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
    <link href="{{asset('public/Catering')}}/js/datepicker/datepicker.css" rel="stylesheet" />
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
                            <h3 class="m-b-none">添加会员卡</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                添加会员卡
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" id="currentForm" action="{{ url('catering/ajax/member_add_check') }}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">会员卡名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" placeholder="会员卡名称" name="member_name">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">折扣比率</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" placeholder="0 - 1 间的 2位小数" name="discount">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">发行数量</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" name="issue_mun">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">会员卡价格</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" name="card_price">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">有效时间</label>
                                        <div class="col-sm-3">
                                            <input class="input-sm datepicker-input form-control" size="16" type="text" value="" placeholder="开始时间" data-date-format="yyyy-mm-dd" name="start_time">
                                        </div>
                                        <div class="col-sm-1 text-center" style="padding-top: 7px;">
                                            到
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="input-sm datepicker-input form-control" size="16" type="text" value="" placeholder="结束时间" data-date-format="yyyy-mm-dd" name="expire_time">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class= "col-sm-2 control-label" for="input-id-1">适用店铺范围</label>
                                        <div class="col-sm-10">
                                            <select multiple class="chosen-select col-sm-12" name="adapt_store[]">
                                                <option value="0" >所有分店</option>
                                                <option value="HI">刘记鸡煲王（总店）</option>
                                                <option value="CA">刘记鸡煲王（宝能店）</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" name="safe_password">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-5">
                                            <button type="button" class="btn btn-success" id="addBtn" onclick="return postForm();">保存信息</button>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </form>
                            </div>
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
<script type="text/javascript" src="{{asset('public/Catering')}}/js/datepicker/bootstrap-datepicker.js"></script>
<script src="{{asset('public/Catering')}}/js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript">
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
            }else{
                console.log(json);
//                swal({
//                    title: "提示信息",
//                    text: json.data,
//                    confirmButtonColor: "#DD6B55",
//                    confirmButtonText: "确定",
//                    //type: "warning"
//                });
            }
        });
    }
</script>
</body>
</html>

























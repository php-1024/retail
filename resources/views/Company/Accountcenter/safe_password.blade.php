<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>安全密码设置 | 零壹云管理平台 | 商户管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Company/library/jPlayer')}}/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Company')}}/css/app.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css">
    <!--[if lt IE 9]>
    <script src="{{asset('public/Company/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/respond.min.js"></script>
    <script src="{{asset('public/Company/library/ie')}}/excanvas.js"></script>
    <![endif]-->
</head>

</html>


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
                            <h3 class="m-b-none">安全密码</h3>
                        </div>
                        @if(empty($admin_data['safe_password']))
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                安全密码设置-<b style="color:#f00">您还没有设置安全密码，设置安全密码后才能操作！</b>
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="get">
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">登陆账号</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" disabled="" value="200307">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">重复安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-6">

                                            <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </form>
                            </div>
                        </section>
                        @else
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                安全密码修改
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="get">
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">登陆账号</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" disabled="" value="200307">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">原安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">新安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">重复安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-6">

                                            <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                </form>
                            </div>
                        </section>
                        @endif
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
<script type="text/javascript">
    $(function(){
        $('#addBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
</script>>
</body>
</html>
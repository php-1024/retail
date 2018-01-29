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
                            <h3 class="m-b-none">登陆日志</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                登陆日志列表
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <label class="col-sm-1 control-label">时间范围</label>

                                    <div class="col-sm-2">
                                        <input class="input-sm datepicker-input form-control" size="16" type="text" value="" data-date-format="yyyy-mm-dd">
                                    </div>

                                    <label class="col-sm-1 control-label">到</label>

                                    <div class="col-sm-2">
                                        <input class="input-sm datepicker-input form-control" size="16" type="text" value="" data-date-format="yyyy-mm-dd">
                                    </div>

                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>登陆IP</th>
                                        <th>登陆地址</th>
                                        <th>登陆时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($login_log_list as $key=>$val)
                                    <tr>
                                        <td>{{  $val->accounts->id }}</td>
                                        <td>{{  long2ip($val->ip) }}</td>
                                        <td>{{  $val->ip_position }}</td>
                                        <td>{{  $val->created_at }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">

                                    <div class="col-sm-12 text-right text-center-xs">
                                        {{ $login_log_list->links() }}
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
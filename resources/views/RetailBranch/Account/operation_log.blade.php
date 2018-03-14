<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>操作日志列表 | 零壹云管理平台 | 商户管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch/library/jPlayer')}}/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch/library/sweetalert')}}/sweetalert.css">
    <link rel="stylesheet" href="{{asset('public/Branch/library/datepicker')}}/datepicker.css">

    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch/library/ie')}}/html5shiv.js"></script>
    <script src="{{asset('public/Branch/library/ie')}}/respond.min.js"></script>
    <script src="{{asset('public/Branch/library/ie')}}/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    @include('RetailBranch/Public/Header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('RetailBranch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">操作日志</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                操作日志列表
                            </header>
                        <form method="get" class="form-horizontal" role="form" id="searchForm" action="" onsubmit="return searchFormCheck();">
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <div class="row wrapper">
                                    <label class="col-sm-1 control-label">时间范围</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm datepicker-input form-control zerodate" size="16" type="text" name="time_st" value="{{$search_data['time_st']}}" data-date-format="yyyy-mm-dd">
                                    </div>
                                    <label class="col-sm-1 control-label">到</label>
                                    <div class="col-sm-2">
                                        <input class="input-sm datepicker-input form-control zerodate" size="16" type="text" name="time_nd" value="{{$search_data['time_nd']}}" data-date-format="yyyy-mm-dd">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-s-md btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;搜索</button>
                                    </div>
                            </div>
                        </form>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>操作详情</th>
                                        <th>操作时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($operation_log_list as $key=>$val)
                                        <tr>
                                            <td>{{ $val->accounts->id }}</td>
                                            <td>{{ $val->operation_info }}</td>
                                            <td>{{ $val->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">

                                    <div class="col-sm-12 text-right text-center-xs">
                                        {!! $operation_log_list->links() !!}
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
<!-- App -->
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch/library/slimscroll')}}/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch/library/file-input')}}/bootstrap-filestyle.min.js"></script>
<script src="{{asset('public/Branch/library/jPlayer')}}/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Branch/library/jPlayer')}}/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Branch/library/sweetalert')}}/sweetalert.min.js"></script>
<script src="{{asset('public/Company/library/datepicker')}}/bootstrap-datepicker.js"></script>
<script>
    $(function(){
        $('.branchdate').datepicker({
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
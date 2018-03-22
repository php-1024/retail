<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Tooling/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Tooling/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/Tooling')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Tooling')}}/css/style.css" rel="stylesheet">

</head>

<body class="">

<div id="wrapper">

    @include('Tooling/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Tooling/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>管理首页</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="JavaScript:;">系统管理</a>
                    </li>
                    <li class="active">
                        <strong>管理首页</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="ibox-content forum-container">

                        <div class="forum-title">

                            <h3>程序统计</h3>
                        </div>

                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-area-chart"></i>
                                    </div>
                                    <a href="javascript:;" class="forum-item-title">程序数量</a>
                                    <div class="forum-sub-title">零壹开发的所有程序数量</div>
                                </div>


                                <div class="col-md-3 forum-info">
                                            <span class="views-number">
                                                {{ $count_data['program_count'] }}套
                                            </span>
                                    <div>
                                        <small>总计</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-area-chart"></i>
                                    </div>
                                    <a href="javascript:;" class="forum-item-title">功能模块数量</a>
                                    <div class="forum-sub-title">零壹开发的所有功能模块的数量</div>
                                </div>

                                <div class="col-md-3 forum-info">
                                            <span class="views-number">
                                                {{ $count_data['module_count'] }}个
                                            </span>
                                    <div>
                                        <small>总计</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-area-chart"></i>
                                    </div>
                                    <a href="javascript:;" class="forum-item-title">功能节点数量</a>
                                    <div class="forum-sub-title">组成零壹所有系统的程序节点数量</div>
                                </div>
                                <div class="col-md-3 forum-info">
                                            <span class="views-number">
                                                {{ $count_data['node_count'] }}个
                                            </span>
                                    <div>
                                        <small>总计</small>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="row wrapper wrapper-content animated fadeInRight">
                <div class="col-lg-7">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户登录日志</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>用户</th>
                                    <th>登录IP</th>
                                    <th>登录地址</th>
                                    <th>登录时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($login_log_list as $key=>$val)
                                    <tr>
                                        <td>{{  $val->accounts->account }}</td>
                                        <td>{{  long2ip($val->ip) }}</td>
                                        <td>{{  $val->ip_position }}</td>
                                        <td>{{  $val->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户操作日志</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>用户</th>

                                    <th>操作</th>
                                    <th>时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($operation_log_list as $key=>$val)
                                <tr>
                                    <td>{{ $val->accounts->account }}</td>

                                    <td>{{ $val->operation_info }}</td>
                                    <td>{{ $val->created_at }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Tooling/Public/Footer')
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/Tooling/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Tooling/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Tooling/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Tooling/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Tooling')}}/js/inspinia.js"></script>
<script src="{{asset('public/Tooling/library/pace')}}/js/pace.min.js"></script>

</body>

</html>

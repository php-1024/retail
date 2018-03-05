<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>角色添加 | 零壹云管理平台 | 分店管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch/library')}}/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css" />
    <link href="{{asset('public/Branch/library')}}/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{asset('public/Branch/library')}}/iCheck/css/custom.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch/library')}}/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch/library')}}/ie/excanvas.js"></script>
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
                            <h3 class="m-b-none">分店概况</h3>
                        </div>

                        <div class="col-lg-3">
                            <section class="panel panel-default">

                                <header class="panel-heading font-bold">
                                    概况

                                    <button id="editBtn" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit "></i>&nbsp;编辑</button>
                                </header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="get">
                                        <div class="form-group clearfix text-center m-t">
                                            <div class="inline">
                                                <div class="thumb-lg" >
                                                    <img src="{{url('public/Branch/images/m0.jpg')}}" class="img-circle" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">模式</label>
                                            <div class="col-sm-8">
                                                <div>
                                                    <label class="label label-success m-t-xs">
                                                        餐饮系统【先吃后付】
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">分店名称</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">刘记鸡煲王【龙岗店】</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">类型</label>
                                            <div class="col-sm-8">
                                                <label class="label label-success">主店</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">负责人</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">张老三</label>
                                            </div>
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">手机号码</label>
                                            <div class="col-sm-8">
                                                <label class="label label-info">13123456789</label>
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">状态</label>
                                            <div class="col-sm-8">
                                                <label class="label label-success">正常运营</label>
                                            </div>
                                        </div>

                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                        <div class="form-group">
                                            <label class="col-sm-4 text-right" for="input-id-1">店铺地址</label>
                                            <div class="col-sm-8">
                                                <label class="label label-primary">广东省深圳市龙岗区万汇大厦1606</label>
                                            </div>
                                        </div>


                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-9 ">
                            <div class="col-lg-12">
                                <div class="col-lg-4 state-overview"">
                                <section class="panel">
                                    <div class="symbol bg-danger">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="value">
                                        <h1>168888.03</h1>
                                        <p>元营收</p>
                                    </div>
                                </section>
                            </div>

                            <div class="col-lg-4 state-overview"">
                            <section class="panel">
                                <div class="symbol bg-success">
                                    <i class="icon icon-user"></i>
                                </div>
                                <div class="value">
                                    <h1>1680</h1>
                                    <p>个粉丝用户</p>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-4 state-overview"">
                        <section class="panel">
                            <div class="symbol bg-info">
                                <i class="icon icon-basket-loaded"></i>
                            </div>
                            <div class="value">
                                <h1>100</h1>
                                <p>个商品</p>
                            </div>
                        </section>
                        </div>


                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-4 state-overview"">
                            <section class="panel">
                                <div class="symbol bg-warning">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="value">
                                    <h1>666</h1>
                                    <p>现场订单数</p>
                                </div>
                            </section>
                        </div>

                        <div class="col-lg-4 state-overview"">
                        <section class="panel">
                            <div class="symbol bg-primary">
                                <i class="icon icon-list"></i>
                            </div>
                            <div class="value">
                                <h1>888</h1>
                                <p>外卖订单</p>
                            </div>
                        </section>
                        </div>

                        <div class="col-lg-4 state-overview"">
                        <section class="panel">
                            <div class="symbol bg-dark">
                                <i class="icon icon-printer"></i>
                            </div>
                            <div class="value">
                                <h1>5</h1>
                                <p>台打印机</p>
                            </div>
                        </section>
                        </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading">最近登录日志</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>登录账号</th>
                                            <th>登录IP</th>
                                            <th>登录地址</th>
                                            <th>登录时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>

                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>192.168.1.1</td>
                                            <td>中国广东深圳</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>

                            <div class="col-lg-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading">最近操作日志</header>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th>操作账号</th>
                                            <th>操作内容</th>
                                            <th>操作时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        <tr>
                                            <td>10200</td>
                                            <td>修改了登录密码</td>
                                            <td>2018-09-09 11:11:11</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch/library')}}/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch/library')}}/file-input/bootstrap-filestyle.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/jquery.jplayer.min.js"></script>
<script src="{{asset('public/Branch/library')}}/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script src="{{asset('public/Branch/library')}}/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('public/Branch/library')}}/iCheck/js/icheck.min.js"></script>
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $('.checkbox_module_name').on('ifChecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
            var id = $(this).val();
            $('.checkbox_node_name_'+id).iCheck('check') ;
        }).on('ifUnchecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
            var id = $(this).val();
            $('.checkbox_node_name_'+id).iCheck('uncheck') ;
        });
        $('.checkbox_node_name').on('ifUnchecked',function(event){
            var group_id = $(this).attr('data-group_id');
            var tag=false;
            $('.checkbox_node_name_'+group_id).each(function(i,v){
                if($('.checkbox_node_name_'+group_id+':eq('+i+')').is(":checked")){
                    tag=true;
                }
            });
            if(tag==false){
                $('.checkbox_module_name_'+group_id).iCheck('uncheck') ;
            }
        });
    });
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
                    confirmButtonText: "确定"
                },function(){
                    window.location.reload();
                });
            }else{
                console.log(json);
            }
        });
    }
</script>
</body>
</html>

























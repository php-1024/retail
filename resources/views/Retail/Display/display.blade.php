<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>零壹云管理平台 | 零售版店铺管理系统</title>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/library/jPlayer/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('public/Branch')}}/css/app.css" type="text/css"/>
    <link href="{{asset('public/Branch')}}/library/sweetalert/sweetalert.css" rel="stylesheet"/>
    <!--[if lt IE 9]>
    <script src="{{asset('public/Branch')}}/library/ie/html5shiv.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/respond.min.js"></script>
    <script src="{{asset('public/Branch')}}/library/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">
    {{--头部--}}
    @include('Retail/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
        @include('Retail/Public/Nav')
        <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">店铺概况</h3>
                        </div>

                        <div class="col-lg-3">
                            <section class="panel panel-default">

                                <header class="panel-heading font-bold">
                                    概况
                                    <button class="btn btn-default btn-xs pull-right" id="editBtn"><i
                                                class="fa fa-edit "></i>&nbsp;编辑
                                    </button>
                                </header>
                                <div class="panel-body">
                                        <div class="form-group clearfix text-center m-t">
                                            <div class="inline">
                                                <div class="thumb-lg">
                                                    <img src="{{url('public/Branch/images/m0.jpg')}}" class="img-circle"
                                                         alt="...">
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
                                            <label class="col-sm-4 text-right" for="input-id-1">店铺名称</label>
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
                                <div class="col-lg-4 state-overview"
                                ">
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

                            <div class="col-lg-4 state-overview"
                            ">
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

                        <div class="col-lg-4 state-overview"
                        ">
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
                            <div class="col-lg-4 state-overview"
                            ">
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

                        <div class="col-lg-4 state-overview"
                        ">
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

                        <div class="col-lg-4 state-overview"
                        ">
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
                                        @foreach($login_log_list as $key=>$val)
                                            <tr>
                                                <td>{{$val->accounts->account}}</td>
                                                <td>{{  long2ip($val->ip) }}</td>
                                                <td>{{  $val->ip_position }}</td>
                                                <td>{{  $val->created_at }}</td>
                                            </tr>
                                        @endforeach
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
                                        @foreach($operation_log_list as $key=>$val)
                                            <tr>
                                                <td>{{ $val->accounts->id }}</td>
                                                <td>{{ $val->operation_info }}</td>
                                                <td>{{ $val->created_at }}</td>
                                            </tr>
                                        @endforeach
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


{{--编辑店铺信息--}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" role="form" id="store_edit" method="post" enctype="multipart/form-data" action="">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <input type="hidden" name="organization_id" id="organization_id" value="{{$admin_data['organization_id']}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">店铺信息编辑</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 text-right">分店名称</label>
                        <div class="col-sm-10">
                            <input type="text" value="刘记鸡煲王【龙岗店】" name="store_name" placeholder="店铺名称" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>


                    <div class="form-group">
                        <label class="col-sm-2 text-right">负责人</label>
                        <div class="col-sm-10">
                            <input type="text" value="张老三" name="owner" placeholder="负责人" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" value="13123456789" name="mobile" placeholder="手机号码" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">店铺LOGO</label>
                        <div class="col-sm-10">
                            <input type="file" name="retail_logo" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">店铺地址</label>
                        <div class="col-sm-10">
                            <input type="text" value="广东省深圳市龙岗区万汇大厦1606" name="address" placeholder="店铺地址" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">安全密码</label>
                        <div class="col-sm-10">
                            <input type="password" value="" name="safe_password" placeholder="安全密码" class="form-control" >
                        </div>
                    </div>
                    <div style="clear:both;"></div>

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" onclick="return EditStore()">确定</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{--编辑店铺信息--}}


<script src="{{asset('public/Branch')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('public/Branch')}}/js/bootstrap.js"></script>
<!-- App -->
<script src="{{asset('public/Branch')}}/js/app.js"></script>
<script src="{{asset('public/Branch')}}/library/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('public/Branch')}}/js/app.plugin.js"></script>
<script src="{{asset('public/Branch')}}/library/file-input/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/jPlayer/demo.js"></script>
<script type="text/javascript" src="{{asset('public/Branch')}}/library/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $('#editBtn').click(function () {
        $('#myModal').modal();
    });

    //编辑店铺信息
    function EditStore() {
        var formData = new FormData($( "#store_edit" )[0]);
        var _token = $('#_token').val();
        $.ajax({
            url: '{{ url('retail/ajax/store_edit') }}',
            type: 'post',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (json) {
                if (json.status == -1) {
                    window.location.reload();
                } else if(json.status == 1) {
                    swal({
                        title: "提示信息",
                        text: json.data,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定",
                    },function(){
                        //图片添加成功后异步刷新图片列表部分
                        var url = '{{url('retail/ajax/goods_thumb')}}';//需要异步加载的页面
                        var goods_id = $("#goods_id").val();
                        var token = $("#_token").val();
                        var data = {'goods_id':goods_id,'_token':token};
                        $.post(url,data,function(response){
                            if(response.status=='-1'){
                                swal({
                                    title: "提示信息",
                                    text: response.data,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "确定",
                                },function(){
                                    window.location.reload();
                                });
                                return;
                            }else{
                                $('#thumb_content').html(response);
                                $('#myModal_thumb').modal('hide');
                            }
                        });
                    });
                }else{
                    swal({
                        title: "提示信息",
                        text: json.data,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定"
                    });
                }
            },
            error: function (json) {
                console.log(json);
            }
        });
    }
</script>
</body>
</html>
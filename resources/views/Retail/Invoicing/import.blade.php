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
                            <h3 class="m-b-none">粉丝标签管理</h3>
                        </div>

                        <section class="panel panel-default">
                            <header class="panel-heading">
                                粉丝标签管理
                            </header>
                            <div class="row wrapper">
                                <form class="form-horizontal" method="get">
                                    <div class="col-sm-12">
                                        <button type="button" id="addBtn" class="btn btn-s-md btn-info"><i
                                                    class="fa fa-plus"></i>&nbsp;&nbsp;添加粉丝标签
                                        </button>
                                        <button type="button" class="btn btn-s-md btn-info"><i
                                                    class="icon icon-cloud-download"></i>&nbsp;&nbsp;同步微信标签到本地
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>标签名称</th>
                                        <th>标签粉丝数</th>
                                        <th>操作时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>广东粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i
                                                        class="fa fa-times"></i>&nbsp;&nbsp;删除
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>河南粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i
                                                        class="fa fa-times"></i>&nbsp;&nbsp;删除
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>广西粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i
                                                        class="fa fa-times"></i>&nbsp;&nbsp;删除
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>湖南粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i
                                                        class="fa fa-times"></i>&nbsp;&nbsp;删除
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>吉林粉丝</td>
                                        <td>260</td>
                                        <td>2017-08-09 11:11:11</td>
                                        <td>
                                            <button class="btn btn-info btn-xs" id="editBtn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑
                                            </button>
                                            <button class="btn btn-danger btn-xs" id="deleteBtn"><i
                                                        class="fa fa-times"></i>&nbsp;&nbsp;删除
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">

                                    <div class="col-sm-12 text-right text-center-xs">
                                        <ul class="pagination pull-right">
                                            <li class="footable-page-arrow disabled">
                                                <a data-page="first" href="#first">«</a>
                                            </li>

                                            <li class="footable-page-arrow disabled">
                                                <a data-page="prev" href="#prev">‹</a>
                                            </li>
                                            <li class="footable-page active">
                                                <a data-page="0" href="#">1</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">2</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">3</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">4</a>
                                            </li>
                                            <li class="footable-page">
                                                <a data-page="1" href="#">5</a>
                                            </li>
                                            <li class="footable-page-arrow">
                                                <a data-page="next" href="#next">›</a>
                                            </li>
                                            <li class="footable-page-arrow">
                                                <a data-page="last" href="#last">»</a>
                                            </li>
                                        </ul>
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
                        <label class="col-sm-2 text-right">店铺名称</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$organization->organization_name}}" name="organization_name" placeholder="店铺名称" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>


                    <div class="form-group">
                        <label class="col-sm-2 text-right">负责人</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$organization->OrganizationRetailinfo->retail_owner}}" name="retail_owner" placeholder="负责人" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$organization->OrganizationRetailinfo->retail_owner_mobile}}" name="mobile" placeholder="手机号码" class="form-control">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">店铺LOGO</label>
                        <div class="col-sm-10">
                            <input type="file" name="retail_logo" value="{{$organization->OrganizationRetailinfo->retail_logo}}" class="filestyle" style="display: none;" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">店铺地址</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$organization->OrganizationRetailinfo->retail_address}}" name="retail_address" placeholder="店铺地址" class="form-control">
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
        $.ajax({
            url: '{{ url('retail/ajax/store_edit_check') }}',
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
                        window.location.reload();
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
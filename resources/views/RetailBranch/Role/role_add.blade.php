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
    @include('CateringBranch/Public/Header')
    {{--头部--}}
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('CateringBranch/Public/Nav')
            <!-- /.aside -->
            <section id="content">
                <section class="vbox">
                    <section class="scrollable padder">
                        <div class="m-b-md">
                            <h3 class="m-b-none">角色添加</h3>
                        </div>
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                角色添加
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" id="currentForm" method="post" action="{{url('cateringbranch/ajax/role_add_check')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">角色名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value=""  name="role_name">
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">角色权限</label>
                                        <div class="col-sm-10">
                                            <div class="panel-body">
                                                @foreach($module_node_list as $key=>$val)
                                                    <group class="checked_box_group_{{ $val['id'] }}">
                                                        <div>
                                                            <label class="i-checks">
                                                                <input type="checkbox" class="checkbox_module_name checkbox_module_name_{{ $val['id'] }}" value="{{ $val['id'] }}" id="inlineCheckbox1" > {{ $val['module_name'] }}
                                                            </label>
                                                        </div>
                                                        <div>
                                                            @foreach($val['program_nodes'] as $kk=>$vv)
                                                                <label class="i-checks">
                                                                    <input type="checkbox" data-group_id="{{  $val['id'] }}" class="checkbox_node_name_{{ $val['id'] }}" name="module_node_ids[]" value="{{ $vv['id'] }}" id="inlineCheckbox1"  > {{ $vv['node_name'] }}
                                                                </label>
                                                                &nbsp;&nbsp;
                                                            @endforeach

                                                        </div>
                                                    </group>
                                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-id-1" value="" name="safe_password">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <div class="col-sm-12 col-sm-offset-6">

                                            <button type="button" onclick="return postForm();" class="btn btn-success" id="addBtn">保存信息</button>
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

























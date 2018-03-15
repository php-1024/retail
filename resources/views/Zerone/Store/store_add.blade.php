<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>
    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">

    <link href="{{asset('public/Zerone/library/sweetalert')}}/css/sweetalert.css" rel="stylesheet">

    <link href="{{asset('public/Zerone')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('public/Zerone')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/chosen')}}/css/chosen.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library')}}/iCheck/css/custom.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library')}}/switchery/css/switchery.css" rel="stylesheet">
    <!-- Mainly scripts -->

</head>

<body class="">

<div id="wrapper">

    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>添加店铺</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">店铺管理</a>
                    </li>
                    <li >
                        <strong>添加店铺</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <input type="hidden" id="store_insert" value="{{url('zerone/ajax/store_insert')}}">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <div class="ibox-title">
                            <h5>添加店铺</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>程序名称</th>
                                    <th>程序模块</th>
                                    <th class="col-sm-2 text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $key=>$val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->program_name }}</td>
                                    <td>
                                        @foreach($module_list[$val->id] as $k=>$v)
                                        <label class="label label-primary" data-container="body" data-toggle="popover" data-placement="top" data-content="@foreach($v->program_nodes as $kk=>$vv)  {{ $vv->node_name }} @endforeach" style="display:inline-block">{{ $v->module_name }}</label>&nbsp;&nbsp;
                                        @endforeach
                                    </td>
                                    <td class="text-right">
                                        <button type="button" id="addbtn" class="btn  btn-xs btn-danger" onclick="getAddForm({{ $val->id }})"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;开设店铺</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Zerone/Public/Footer')
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
</div>
{{--<!-- Page-Level Scripts -->--}}
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>

<!-- Sweet alert -->
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>
<script src="{{asset('public/Tooling/library/chosen')}}/js/chosen.jquery.js"></script>

<script>

    //编辑
    function getAddForm(id){
        $('.chosen-select').chosen({width:"100%",no_results_text:'对不起，没有找到结果！关键词：'});
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        var url = $('#store_insert').val();
        var token = $('#_token').val();
        if(id==''){
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            },function(){
                window.location.reload();
            });
            return;
        }

        var data = {'id':id,'_token':token};
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

                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>

</body>

</html>

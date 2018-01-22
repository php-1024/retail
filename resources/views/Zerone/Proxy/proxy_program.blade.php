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


</head>

<body class="">


<div id="wrapper">
    @include('Zerone/Public/Nav')

    <div id="page-wrapper" class="gray-bg">
        @include('Zerone/Public/Header')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>“刘记新科技有限公司”程序管理</h2>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="JavaScript:;">服务商管理</a>
                    </li>
                    <li >
                        <strong>“刘记新科技有限公司”程序管理</strong>
                    </li>
                </ol>
            </div>

        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">


            <div class="ibox-content m-b-sm border-bottom">

                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="amount"> &nbsp;</label>
                            <button type="button" onclick="history.back()" class="block btn btn-info"><i class="fa fa-reply"></i>&nbsp;&nbsp;返回列表</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                <input type="hidden" name="organization_id" id="organization_id" value="{{$listOrg->id}}">
                <input type="hidden" id="company_assets_add" value="{{ url('zerone/ajax/company_assets_add') }}">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>“{{$listOrg->organization_name}}”程序管理</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>套餐名称</th>
                                    <th>包含程序</th>
                                    <th>添加时间</th>
                                    <th class="text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $key=>$value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->package_name}}</td>

                                        <td>
                                            @foreach($value->programs as $k=>$v)
                                                <div>
                                                    <span class="label label-danger"><i class="icon-code"></i> {{$v->program_name}}</span> &nbsp;&nbsp;
                                                    <span class="label label-primary">剩余：1 套</span>&nbsp;&nbsp;
                                                    <span class="label label-warning">已用：1 套</span>&nbsp;&nbsp;
                                                </div>
                                                <div style=" margin-top: 20px;"></div>
                                            @endforeach
                                        </td>
                                        <td>{{$value->created_at}}</td>
                                        <td class="text-right">
                                            <button class="btn btn-info btn-xs" onclick="getAssetsAdd('{{$v->id}}')"><i class="icon-arrow-down"></i>&nbsp;&nbsp;程序划入</button>
                                            <button class="btn btn-primary btn-xs"><i class="icon-arrow-up"></i>&nbsp;&nbsp;程序划出</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="99">
                                        <ul class="pagination pull-right">
                                            {{$list->links()}}
                                        </ul>
                                    </td>
                                </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Zerone/Public/Footer')
    </div>
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <h3>“刘记新科技有限公司”程序划入</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label class="col-sm-4 control-label">微餐饮系统（先吃后付）通用版本</label>
                        <div class="col-sm-2">主程序：188套</div>
                        <div class="col-sm-2">分店数：1880套</div>

                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="padding-top: 7px;">主程序划入</label>
                        <div class="col-sm-4" ><input type="text" class="form-control"></div>
                        <div class="col-sm-1" style="padding-top: 7px;">套</div>

                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="padding-top: 7px;">分店划入</label>
                        <div class="col-sm-4" ><input type="text" class="form-control"></div>
                        <div class="col-sm-1" style="padding-top: 7px;">家</div>

                    </div>

                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">安全密码</label>
                        <div class="col-sm-10"><input type="password" class="form-control" value=""></div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="hr-line-dashed"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary saveBtn">保存</button>
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h3>“刘记新科技有限公司”程序划出</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"><label class="col-sm-4 control-label">微餐饮系统（先吃后付）通用版本</label>
                            <div class="col-sm-2">主程序：188套</div>
                            <div class="col-sm-2">分店数：1880套</div>

                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="padding-top: 7px;">主程序划出</label>
                            <div class="col-sm-4" ><input type="text" class="form-control"></div>
                            <div class="col-sm-1" style="padding-top: 7px;">套</div>

                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="padding-top: 7px;">分店划出</label>
                            <div class="col-sm-4" ><input type="text" class="form-control"></div>
                            <div class="col-sm-1" style="padding-top: 7px;">家</div>

                        </div>

                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">安全密码</label>
                            <div class="col-sm-10"><input type="password" class="form-control" value=""></div>
                        </div>
                        <div style="clear:both"></div>
                        <div class="hr-line-dashed"></div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary saveBtn">保存</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
<script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
<script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
<script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script src="{{asset('public/Zerone/library/sweetalert')}}/js/sweetalert.min.js"></script>
<!-- Page-Level Scripts -->

<script>
    $(document).ready(function() {
        // activate Nestable for list 2
        $('#huabo_btn').click(function(){
            $('#myModal').modal();
        });
        $('#koujian_btn').click(function(){
            $('#myModal2').modal();
        });
        $('.saveBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            },function(){
                window.location.reload();
            });
        });
    });
</script>

</body>

</html>

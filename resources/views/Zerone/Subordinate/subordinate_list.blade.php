<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>零壹新科技程序管理平台</title>

    <link href="{{asset('public/Zerone/library/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/Zerone/library/font')}}/css/font-awesome.css" rel="stylesheet">

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
                <h2>下级人员列表</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="JavaScript:;">系统管理</a>
                    </li>
                    <li class="active">
                        <strong>下级人员列表</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <form method="get" role="form" id="searchForm" action="">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="role_edit_url" value="{{ url('zerone/ajax/role_edit') }}">
                        <input type="hidden" id="role_delete_comfirm_url" value="{{ url('zerone/ajax/role_delete_comfirm') }}">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount">用户账号</label>
                                <input type="text" id="account" name="account" value="{{ $search_data['account'] }}" placeholder="用户账号" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="amount"> &nbsp;</label>
                                <button type="submit" class="block btn btn-info"><i class="fa fa-search"></i>搜索</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <table class="table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户账号</th>
                                    <th>用户角色</th>
                                    <th>真实姓名</th>
                                    <th>联系方式</th>
                                    <th>用户状态</th>
                                    <th>用户层级</th>
                                    <th>添加时间</th>
                                    <th class="text-right">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $key=>$val)
                                    <tr>
                                        <td>{{ $val->id }}</td>
                                        <td>{{ $val->account }}</td>
                                        <td>@foreach($val->account_roles as $k=>$v) {{$v->rolename}} @endforeach</td>
                                        <td>{{ $val->account_info->realname }}</td>
                                        <td>{{ $val->mobile }}</td>
                                        <td>
                                            @if($val->status == '1')
                                                <label class="label label-primary">正常</label>
                                            @else
                                                <label class="label label-warning">已冻结</label>
                                            @endif
                                        </td>
                                        <td>第{{ $val->deepth }}层</td>
                                        <td>{{ $val->created_at }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn  btn-xs btn-primary"  onclick="getEditForm({{ $val->id }})"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                                            <button type="button" class="btn  btn-xs btn-danger" onclick="getDeleteComfirmForm({{ $val->id }})"><i class="fa fa-remove"></i>&nbsp;&nbsp;删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="99" class="text-right">
                                        {{ $list->appends($search_data)->links() }}
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
</div>
    <!-- Mainly scripts -->
    <script src="{{asset('public/Zerone/library/jquery')}}/js/jquery-2.1.1.js"></script>
    <script src="{{asset('public/Zerone/library/bootstrap')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/Zerone/library/metisMenu')}}/js/jquery.metisMenu.js"></script>
    <script src="{{asset('public/Zerone/library/slimscroll')}}/js/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('public/Zerone')}}/js/inspinia.js"></script>
    <script src="{{asset('public/Zerone/library/pace')}}/js/pace.min.js"></script>

</body>

</html>

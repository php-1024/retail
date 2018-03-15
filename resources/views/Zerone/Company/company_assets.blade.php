<link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
<form class="form-horizontal tasi-form" method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/company_assets_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="organization_id" value="{{$listOrg->id}}">
    <input type="hidden" name="package_id" value="{{$listPac->id}}">
    <input type="hidden" name="status" value="{{$status}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">@if($status == 1)程序划入@else程序划出@endif</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal tasi-form" method="get">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商户名称</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$listOrg->organization_name}}" placeholder="商户名称" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">套餐名称</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$listPac->package_name}}" placeholder="套餐名称" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">程序名称</label>
                            <div class="col-sm-9">
                                <select class="form-control m-b" name="program_id">
                                    @foreach($listPac->programs as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->program_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-2">
                                <input type="text" value="0" name="num" class="form-control" >
                            </div>
                            <label class="col-sm-2 control-label">套</label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">安全密码</label>
                            <div class="col-sm-9">
                                <input type="password" value="" name="safe_password" placeholder="安全密码" class="form-control" >
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" onclick="postForm()">确定</button>
                </div>
            </div>
        </div>
    </form>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
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
<form class="form-horizontal tasi-form" method="post" role="form" id="currentForm" action="{{ url('Agent/ajax/subordinate_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <input type="hidden" name="account" id="account" value="{{ $info->account }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">编辑用户</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户账号</label>
                    <div class="col-sm-10"><input type="text" value="{{ $info->account }}" disabled="" class="form-control"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户密码</label>
                    <div class="col-sm-10"><input type="password" class="form-control" name="password"  value=""></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">真实姓名</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="realname" value="@if(!empty($info->account_info)){{ $info->account_info->realname }}@endif"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">联系方式</label>
                    <div class="col-sm-10"><input type="text" class="form-control"  name="mobile" value="{{ $info->mobile }}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">安全密码</label>
                    <div class="col-sm-10"><input type="password" class="form-control"  name="safe_password"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn" onclick="return postForm();">保存</button>
            </div>
        </div>
    </div>
</form>

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
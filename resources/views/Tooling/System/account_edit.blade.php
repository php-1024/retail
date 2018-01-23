<form method="post" role="form" id="currentForm" action="{{ url('tooling/ajax/account_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{ $info->id }}">
    <input type="hidden" name="account" value="{{ $info->account }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改用户密码
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>用户账号</label>
                    {{ $info->account }}
                </div>
                <div class="form-group">
                    <label>新登录密码</label>
                    <input type="password" placeholder="请输入新登录密码" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>重复新密码</label>
                    <input type="password" placeholder="请再次输入新登录密码" name="repassword" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="return postForm();">保存</button>
            </div>
        </div>
    </div>
</form>
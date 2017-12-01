<form method="post" role="form" id="currentForm" action="{{ url('program/ajax/check_edit_password') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改用户密码
            </div>
            <div class="modal-body">
                <div class="form-group"><label class="col-sm-2 control-label">登陆账号</label>
                    <div class="col-sm-10" style="padding-top:7px;">admin</div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">原登陆密码</label>
                    <div class="col-sm-10"><input type="password" name="oldpassword" class="form-control" placeholder="原登陆密码"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">新登陆密码</label>
                    <div class="col-sm-10"><input type="password" name="password" class="form-control" placeholder="新登陆密码"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">重复新密码</label>
                    <div class="col-sm-10"><input type="password" name="repassword" class="form-control" placeholder="重复新密码"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</form>
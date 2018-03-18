<div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <h3>“{{$onedata->organization_name}}”店铺划出</h3>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">划出店铺</label>
                <div class="col-sm-9"><input type="text" class="form-control" value="{{$onedata->organization_name}}" readonly></div>
            </div>
            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top: 7px;">归还程序与分店数量</label>
                <div class="col-sm-9">
                    <input type="checkbox" class="js-switch2" checked  value="1"/>
                </div>

            </div>

            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label">安全密码</label>
                <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
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


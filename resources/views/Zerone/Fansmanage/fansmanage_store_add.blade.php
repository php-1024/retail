<div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <h3>“刘记餐饮集团”店铺划入</h3>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top: 7px;">请选择要划入的店铺</label>
                <div class="col-sm-9">
                    <select data-placeholder="请店铺" class="chosen-select" style="width:350px;" tabindex="4" name="store_id">
                       @foreach($list as $key=>$value)
                        <option value="{{$value->id}}">{{$value->organization_name}}</option>
                       @endforeach
                    </select>
                </div>

            </div>

            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top: 7px;">消耗程序与分店数量</label>
                <div class="col-sm-9">
                    <input type="checkbox" class="js-switch" checked  value="1" name="status"/>
                </div>

            </div>

            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label">安全密码</label>
                <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
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

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改战区
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>战区名称</label>
                    <input type="text" placeholder="请输入战区名称" name="zone_name" value="" class="form-control">
                </div>

                <div class="form-group">
                    <label>包含省份</label>
                    <div style="clear: both;"></div>
                    <select data-placeholder="请选择省份" class="chosen-select2" multiple style="width:350px;" tabindex="2">
                        {{--所有战区未选中的战区--}}
                        @foreach($new_province_name as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                        {{--所有战区未选中的战区--}}
                    </select>
                    <div style="clear: both;"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
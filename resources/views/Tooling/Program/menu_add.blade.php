<form method="post" role="form" id="currentForm" action="{{ url('tooling/ajax/menu_add_check') }}">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="program_id" id="id" value="{{ $info->id }}">
<div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            "{{$info->program_name}}"菜单添加
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-10"><input type="text" class="form-control" name="menu_name" value="" placeholder="菜单名称"></div>
            </div>

            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上级菜单</label>
                <div class="col-sm-10">
                    <select class="form-control m-b" name="parent_id">
                        <option value="0">一级菜单</option>
                    </select>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">根菜单（带链接）</label>
                <div class="col-sm-10">
                    <select class="form-control m-b" name="is_root">
                        <option>是</option>
                        <option>否</option>
                    </select>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ICON样式</label>
                <div class="col-sm-10"><input type="text" name="icon_class" class="form-control" value="" placeholder="ICON样式"></div>
            </div>
            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">路由地址</label>
                <div class="col-sm-10"><input type="text" name="menu_route" class="form-control" value="" placeholder="路由地址"></div>
            </div>
            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">关联路由列表</label>
                <div class="col-sm-10"><input type="text" name="menu_routes_bind" class="form-control" value="" placeholder="关联路由列表"></div>
            </div>
            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary">保存</button>
        </div>
    </div>
</div>
</form>
<form method="post" role="form" id="currentForm" action="{{ url('program/ajax/node_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{ $info->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改功能模块
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">模块名称</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="module_name" value="{{ $info->module_name }}"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">模块功能节点</label>
                    <div class="col-sm-4">
                        <select name="from" id="multiselect" class="form-control" style="display: inline-block;" size="8" multiple="multiple">
                            @foreach($node_list_unselected as $key=>$val)
                            <option value="{{ $val->$id }}" data-position="{{ $key }}">{{ $val->node_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                    </div>

                    <div class="col-sm-4">
                        <select name="to" id="multiselect_to" class="form-control" size="8" multiple="multiple">

                            <option value="1" data-position="1">零壹后台管理首页</option>
                            <option value="2" data-position="2">零壹后台添加功能节点</option>
                            <option value="3" data-position="3">零壹后台提交添加功能节点</option>
                            <option value="4" data-position="4">零壹后台编辑功能节点</option>
                            <option value="5" data-position="5">零壹后台提交编辑功能节点</option>
                        </select>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="return postForm();">保存</button>
            </div>
        </div>
    </div>
</form>
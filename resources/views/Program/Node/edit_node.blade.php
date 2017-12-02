<form method="post" role="form" id="currentForm" action="{{ url('program/ajax/check_node_edit') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{ $info->id }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改功能节点
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>节点名称</label>
                    <input type="text" placeholder="请输入节点名称" value="{{ $info->node_name }}" name="node_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>路由名称</label>
                    <input type="text" placeholder="请输入模型名称" value="{{ $info->route_name }}" name="route_name" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</form>
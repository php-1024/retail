<form method="post" role="form" id="currentForm" action="{{ url('program/ajax/node_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{ $info->id }}">
    <div class="modal-dialog modal">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改功能节点
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="return postForm();">保存</button>
            </div>
        </div>
    </div>
</form>
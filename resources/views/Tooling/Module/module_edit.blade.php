<form method="post" role="form" id="currentForm" action="{{ url('tooling/ajax/module_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改功能模块
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">模块名称</label>
                    <div class="col-sm-10"><input type="text" class="form-control" id="edit_module_name" name="module_name" value="{{ $info->module_name }}"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">模块展示名称</label>
                    <div class="col-sm-10"><input type="text" class="form-control" id="edit_module_show_name" name="module_show_name" value="{{ $info->module_show_name }}"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">模块功能节点</label>
                    <div class="col-sm-4">
                        <select name="from" id="multiselect" class="form-control" style="display: inline-block;" size="8" multiple="multiple">
                            @foreach($node_list_unselected as $key=>$val)
                            <option value="{{ $val->id }}" data-position="{{ $val->id }}">{{ $val->node_name }}</option>
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
                            @foreach($node_list_selected as $kk=>$vv)
                                <option value="{{ $vv->id }}" data-position="{{ $vv->id }}">{{ $vv->node_name }}</option>
                            @endforeach
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
<script src="{{asset('public/Tooling/library/multiselect')}}/js/multiselect.js"></script>
<script>
$(function(){
    $('#multiselect').multiselect({keepRenderingSort:true});
});
//提交表单
function postForm() {
    var target = $("#currentForm");
    var url = target.attr("action");
    var module_name = $('#edit_module_name').val();
    var module_show_name = $('#edit_module_show_name').val();
    var _token = $('#_token').val();
    var id = $('#id').val();
    var node = '';

    $('#multiselect_to option').each(function(i,v){
        node += 'nodes[]='+$(v).val()+'&';
    });
    node = node.substring(0, node.length-1);
    var data = 'id='+id+'&_token='+_token+'&module_name='+module_name+'&module_show_name='+module_show_name+'&'+node;
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
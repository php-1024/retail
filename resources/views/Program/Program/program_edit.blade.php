<link href="{{asset('public/Program/library/switchery')}}/css/switchery.css" rel="stylesheet">
<form method="post" role="form" id="currentForm" action="{{ url('program/ajax/program_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <input type="hidden" name="current_pid" id="current_pid" value="{{ $info->pid }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改程序
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('program/ajax/program_add_check') }}">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="parent_nodes_url" value="{{ url('program/ajax/program_parents_node') }}">
                    <div class="form-group"><label class="col-sm-2 control-label">程序名称</label>
                        <div class="col-sm-10"><input type="text" name="program_name" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed" style="clear:both;"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择主程序</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="pid" onchange="get_parents_node($(this).val());">
                                <option value="0">独立主程序</option>
                                @foreach($plist as $key=>$val)
                                    <option value="{{ $val->id }}">{{ $val->program_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed" style="clear:both;"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >是否通用</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="is_universal" class="js-switch"  value="1"/>
                        </div>
                    </div>
                    <div class="hr-line-dashed" style="clear:both;"></div>
                    <div class="form-group" id="node_box"></div>
                    <div class="hr-line-dashed" style="clear:both;"></div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="return postForm();">保存</button>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/Program/library/switchery')}}/js/switchery.js"></script>
<script>
    $(function(){
        get_parents_node($('#current_pid').val());
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
    });
    //获取上级程序节点
    function get_parents_node(pid){
        var url =  $('#parent_nodes_url').val();
        var token = $('#_token').val();
        var data = {'_token':token,'pid':pid}
        $.post(url,data,function(response){
            $('#node_box').html(response);
        });
    }
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var module_name = $('#edit_module_name').val();
        var _token = $('#_token').val();
        var id = $('#id').val();
        var node = '';

        $('#multiselect_to option').each(function(i,v){
            node += 'nodes[]='+$(v).val()+'&';
        });
        node = node.substring(0, node.length-1);
        var data = 'id='+id+'&_token='+_token+'&module_name='+module_name+'&'+node;
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
<link href="{{asset('public/Tooling/library/switchery')}}/css/switchery.css" rel="stylesheet">
<form method="post" role="form" id="currentForm" action="{{ url('tooling/ajax/program_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <input type="hidden" name="current_pid" id="current_pid" value="{{ $info->complete_id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改程序
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal"  role="form" id="currentForm" action="{{ url('tooling/ajax/program_add_check') }}">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="parent_nodes_url" value="{{ url('tooling/ajax/program_parents_node') }}">
                    <div class="form-group"><label class="col-sm-2 control-label">程序名称</label>
                        <div class="col-sm-10"><input type="text" name="program_name" value="{{ $info->program_name }}" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed" style="clear:both;"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">程序路由</label>
                        <div class="col-sm-10"><input type="text" name="program_url" value="{{ $info->program_url }}" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed" style="clear:both;"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择主程序</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="complete_id" onchange="get_parents_node($(this).val(),'{{ $info->id }}');">
                                <option value="0">独立主程序</option>
                                @foreach($plist as $key=>$val)
                                    <option value="{{ $val->id }}" @if($val->id == $info['complete_id']) selected="selected"@endif;>{{ $val->program_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed" style="clear:both;"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" >是否资产程序</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="is_asset" name="is_classic" @if($info->is_asset==1) checked @endif class="js-switch2"  value="1"/>
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
<script src="{{asset('public/Tooling/library/switchery')}}/js/switchery.js"></script>
<script>
    $(function(){
        get_parents_node($('#current_pid').val(),$('#id').val());
        var elem = document.querySelector('.js-switch');
        new Switchery(document.querySelector('.js-switch'), { color: '#1AB394' });
        new Switchery(document.querySelector('.js-switch2'), { color: '#1AB394' });
        new Switchery(document.querySelector('.js-switch3'), { color: '#1AB394' });
    });
    //获取上级程序节点
    function get_parents_node(pid,editid){
        var url =  $('#parent_nodes_url').val();
        var token = $('#_token').val();
        var data = {'_token':token,'pid':pid,'editid':editid}
        $.post(url,data,function(response){
            $('#node_box').html(response);
        });
    }
    //提交表单
    function postForm() {
        var target = $("#currentForm");
        var url = target.attr("action");
        var data = target.serialize();
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
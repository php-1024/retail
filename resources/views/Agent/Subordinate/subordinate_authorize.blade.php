<form method="post" role="form" id="currentForm" action="{{ url('Agent/ajax/subordinate_authorize_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <input type="hidden" name="account" id="account" value="{{ $info->account }}">
    <input type="hidden" id="quick_rule_url" value="{{ url('Agent/ajax/quick_rule') }}">
    <input type="hidden" id="selected_rule_url" value="{{ url('Agent/ajax/selected_rule') }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改用户
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">用户账号</label>
                    <div class="col-sm-10">{{ $info->account }}</div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">权限角色</label>
                    <div class="col-sm-3">
                        <select class="form-control m-b" name="role_id" id="role_id">
                            <option value="0">请选择</option>
                            @foreach($role_list as $k=>$v)
                                <option @if($info->account_role == $v->id) selected @endif value="{{ $v->id }}">{{ $v->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2"><button type="button" class="btn btn-primary" onclick="get_quick_rule('#role_id');"><i class="fa fa-arrow-circle-down"></i>&nbsp;&nbsp;快速授权</button></div>
                    <div class="col-sm-2"><button type="button" class="btn btn-primary" onclick="get_selected_rule();"><i class="fa fa-repeat"></i>&nbsp;&nbsp;恢复默认</button></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group" id="module_node_box"></div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">安全密码</label>
                    <div class="col-sm-10"><input type="password" class="form-control" id="safe_password" name="safe_password"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="return postForm();">保存</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        get_selected_rule();
    });

    //获取上级程序节点
    function get_quick_rule(obj){
        var url =  $('#quick_rule_url').val();
        var token = $('#_token').val();
        var role_id = $(obj).val();
        var data = {'_token':token,'role_id':role_id}
        $.post(url,data,function(response){
            $('#module_node_box').html(response);
        });
    }

    //获取默认已经选择了的程序节点
    function get_selected_rule(){
        var url =  $('#selected_rule_url').val();
        var token = $('#_token').val();
        var id = $("#id").val();
        var data = {'_token':token,'id':id}
        $.post(url,data,function(response){
            $('#module_node_box').html(response);
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
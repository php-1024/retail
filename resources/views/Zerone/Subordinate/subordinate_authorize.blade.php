<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/subordinate_authorize_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <input type="hidden" name="account" id="account" value="{{ $info->account }}">
    <input type="hidden" id="quick_rule_url" value="{{ url('zerone/ajax/quick_rule') }}">
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
                                <option value="{{ $v->id }}">{{ $v->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2"><button type="button" class="btn btn-primary" onclick="get_quick_rule('#role_id');"><i class="fa fa-arrow-circle-down"></i>&nbsp;&nbsp;快速授权</button></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group" id="module_node_box">
                    <link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
                    <label class="col-sm-2 control-label">用户权限</label>
                    <div class="col-sm-10">
                        @foreach($module_node_list as $key=>$val)
                            <group class="checked_box_group_{{ $val->id }}">
                                <div>
                                    <label class="i-checks">
                                        <input type="checkbox" class="checkbox_module_name checkbox_module_name_{{ $val->id }}" @if(in_array($val->id,$selected_modules)) checked="checked" @endif value="{{ $val->id }}"> {{ $val->module_name }}
                                    </label>
                                </div>
                                <div>
                                    @foreach($val->program_nodes as $kk=>$vv)
                                        <label class="checkbox-inline i-checks">
                                            <input type="checkbox"  data-group_id="{{ $val->id }}" @if(in_array($vv->id,$selected_nodes)) checked="checked" @endif class="checkbox_node_name checkbox_node_name_{{ $val->id }}" name="module_node_ids[]" value="{{ $vv->id }}"> {{$vv->node_name}}
                                        </label>
                                    @endforeach
                                </div>
                            </group>
                            <div class="hr-line-dashed" style="clear: both;"></div>
                        @endforeach
                    </div>
                    <script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
                    <script>
                        $(function(){
                            $('.i-checks').iCheck({
                                checkboxClass: 'icheckbox_square-green',
                                radioClass: 'iradio_square-green',
                            });
                            $('.checkbox_module_name').on('ifChecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
                                var id = $(this).val();
                                $('.checkbox_node_name_'+id).iCheck('check') ;
                            }).on('ifUnchecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
                                var id = $(this).val();
                                $('.checkbox_node_name_'+id).iCheck('uncheck') ;
                            });
                            $('.checkbox_node_name').on('ifUnchecked',function(event){
                                var group_id = $(this).attr('data-group_id');
                                var tag=false;
                                $('.checkbox_node_name_'+group_id).each(function(i,v){
                                    if($('.checkbox_node_name_'+group_id+':eq('+i+')').is(":checked")){
                                        tag=true;
                                    }
                                });
                                if(tag==false){
                                    $('.checkbox_module_name_'+group_id).iCheck('uncheck') ;
                                }
                            });
                        })
                    </script>
                </div>
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
    //获取上级程序节点
    function get_quick_rule(obj){
        var url =  $('#quick_rule_url').val();
        var token = $('#_token').val();
        var role_id = $(obj).val();
        var account_id = $('#admin_id').val();
        var data = {'_token':token,'role_id':role_id,'account_id':account_id}
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
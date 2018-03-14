<form class="form-horizontal tasi-form" method="post" id="currentForm" action="{{ url('retailbranch/ajax/role_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">店铺信息编辑</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">角色名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-id-1"  name="role_name" placeholder="角色名称" value="{{ $info->role_name }}" placeholder="{{ $info->role_name }}">
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">角色权限</label>
                        <div class="col-sm-10">
                            <div class="panel-body">
                                @foreach($module_node_list as $key=>$val)
                                    <group class="checked_box_group_{{ $val['id'] }}">
                                        <div>
                                            <label class="i-checks">
                                                <input type="checkbox" value="{{ $val['id'] }}" id="inlineCheckbox1"  @if(in_array($val['id'],$selected_modules)) checked="checked" @endif  class="checkbox_module_name checkbox_module_name_{{ $val['id'] }}" value="{{ $val['id'] }}" > {{ $val['module_name'] }}
                                            </label>
                                        </div>
                                        <div>
                                            @foreach($val['program_nodes'] as $kk=>$vv)
                                            <label class="i-checks">
                                                <input type="checkbox" @if(in_array($vv['id'],$selected_nodes)) checked="checked" @endif  data-group_id="{{  $val['id'] }}"  id="inlineCheckbox1" class="checkbox_node_name_{{ $val['id'] }}" name="module_node_ids[]" value="{{ $vv['id'] }}"> {{ $vv['node_name'] }}
                                            </label>
                                            &nbsp;&nbsp;
                                            @endforeach
                                        </div>
                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                    </group>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-id-1" value="" name="safe_password">
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="addBtn" onclick="return postForm();">确定</button>
            </div>
        </div>
    </div>
</form>

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
    });

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
                    confirmButtonText: "确定"
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定"
                });
            }
        });
    }
</script>
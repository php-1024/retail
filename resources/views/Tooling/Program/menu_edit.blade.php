<form method="post" role="form" id="currentForm" action="{{ url('tooling/ajax/menu_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="program_id" id="program_id" value="{{ $info->program_id }}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <input type="hidden" name="parent_id" id="parent_id" value="{{ $info->parent_id }}">
    <input type="hidden" name="second_menu_url" id="second_menu_url" value="{{ url('tooling/ajax/menu_second_get') }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                "{{$info->program->program_name}}"菜单编辑
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">菜单名称</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="menu_name" value="{{ $info->menu_name }}" placeholder="菜单名称"></div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">上级菜单</label>
                    <div class="col-sm-8">
                        <select class="form-control m-b" id="first_menu" onchange="firstMenuSelected(this);">
                            <option value="0" @if($info->parent_id == 0) selected @endif>无</option>
                            @foreach($list as $key=>$val)
                                <option value="{{ $val->id }}" @if((empty($second_list) && $info->parent_id == $val->id) || (!empty($second_list) && $parent_arr[1] == $val->id)) selected @endif>{{ $val->menu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-info" id="first_btn" onclick="showSecondBox();">下一级&nbsp;&nbsp;<i class="fa fa-arrow-circle-down"></i></button>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="form-group" id="second_box" @if(empty($second_list))style="display:none;"@endif>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <select class="form-control m-b" id="second_menu"  onchange="secondMenuSelected(this);">
                            <option value="0">无</option>
                            @if(!empty($second_list))
                                @foreach($second_list as $k=>$v)
                                    <option value="{{$v->id}}" @if($info->parent_id == $v->id) selected @endif>{{ $v->menu_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">根菜单（带链接）</label>
                    <div class="col-sm-10">
                        <select class="form-control m-b" name="is_root">
                            <option value="1" @if($info->is_root == 1) selected @endif>是</option>
                            <option value="0" @if($info->is_root == 0) selected @endif>否</option>
                        </select>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ICON样式</label>
                    <div class="col-sm-10"><input type="text" name="icon_class" class="form-control" value="{{ $info->icon_class }}" placeholder="ICON样式"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">路由地址</label>
                    <div class="col-sm-10"><input type="text" name="menu_route" class="form-control" value="{{ $info->menu_route }}" placeholder="路由地址"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">关联路由列表(以,分隔)</label>
                    <div class="col-sm-10"><input type="text" name="menu_routes_bind" class="form-control" value="{{ $info->menu_routes_bind }}" placeholder="关联路由列表"></div>
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
    function firstMenuSelected(obj){
        $pid = $(obj).val();
        $('#parent_id').val($pid);
        $('#second_box').hide();
    }
    /*
     显示二级菜单
     */
    function showSecondBox(){
        var pid = $('#first_menu').val();
        var program_id = $('#program_id').val();
        if(pid=='0'){
            swal({
                title: "提示信息",
                text: "请选选择一级菜单",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
                //type: "warning"
            });

            return ;
        }
        var url = $('#second_menu_url').val();
        var token = $('#_token').val();
        $.post(url,{'parent_id':pid,'program_id':program_id,'_token':token},function(json){
            if(json.data.length > 0){
                var html = '<option value="0">无</option>';
                $.each(json.data,function(i,v){
                    html+= '<option value="'+ v.id+'">'+ v.menu_name+'</option>';
                });
                $('#second_menu').html(html);
                $('#second_box').show();
            }else{
                swal({
                    title: "提示信息",
                    text: '该菜单下没有子菜单',
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
            }
        });
    }

    function secondMenuSelected(obj){
        $pid = $(obj).val();
        $('#parent_id').val($pid);
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
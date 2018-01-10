<link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
<label class="col-sm-2 control-label">角色权限</label>
<div class="col-sm-10">
    @foreach($module_node_list as $key=>$val)
        <group class="checked_box_group_{{ $val->id }}">
            <div>
                <label class="i-checks">
                    <input type="checkbox" class="checkbox_module_name checkbox_module_name_{{ $val->id }}" value="{{ $val->id }}"> {{ $val->module_name }}
                </label>
            </div>
            <div>
                @foreach($val->program_nodes as $kk=>$vv)
                    <label class="checkbox-inline i-checks">
                        <input type="checkbox"  data-group_id="{{ $val->id }}" class="checkbox_node_name checkbox_node_name_{{ $val->id }}" name="module_node_ids[]" value="{{ $vv->id }}"> {{$vv->node_name}}
                    </label>
                @endforeach
            </div>
        </group>
        <div class="hr-line-dashed" style="clear: both;"></div>
    @endforeach
</div>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
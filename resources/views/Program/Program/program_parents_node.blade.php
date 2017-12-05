<label class="col-sm-2 control-label" >程序功能模块</label>
<div class="col-sm-10">
    @foreach($module_list as $key=>$val)
    <group class="checked_box_group_{{ $val['id'] }}">
        <div>
            <label class="i-checks">
                <input type="checkbox" class="checkbox_module_name checkbox_module_name_{{ $val['id'] }}" name="module_id[]" value="{{ $val['id'] }}"> {{ $val['module_name'] }}
            </label>
        </div>
        <div>
            @foreach($node_list[$val['id']] as $kk=>$vv)
            <label class="checkbox-inline i-checks">
                <input type="checkbox" data-group_id="{{ $val['id'] }}" class="checkbox_node_name checkbox_node_name_{{ $val['id'] }}" name="module_node_ids[]" value="{{ $vv['module_id'].'_'.$vv['node_id'] }}"> {{$vv['node_name']}}
            </label>
            @endforeach
        </div>
    </group>
    <div class="hr-line-dashed" style="clear: both;"></div>
    @endforeach
</div>
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
</script>
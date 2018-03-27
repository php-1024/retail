<header class="panel-heading font-bold">
    自定义菜单设置
</header>
<div class="panel-body">
    <input type="hidden" id="_token" value="{{csrf_token()}}">
    <input type="hidden" id="conditional_menu_get" value="{{ url('fansmanage/ajax/conditional_menu_get') }}">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-id-1">会员标签组</label>
        <div class="col-sm-10">
            <select name="parent_id" class="form-control m-b" onchange="changeConditionalMenu()">
                <option value ="0">kbzz</option>
                <option value ="0">果粒橙</option>
                <option value ="0">龙的传人</option>
            </select>
        </div>
    </div>
</div>
<script>
    function changeConditionalMenu(){
        var url = $('#conditional_menu_get').val();
        var token = $('#_token').val();
        var data = {'_token':token};
        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#menu_box').html(response);
            }
        });
    }
</script>
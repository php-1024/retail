<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/dashboard_warzone_edit') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="zone_id" id="zone_id" value="">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                修改战区
            </div>
            <div class="modal-body">
                @foreach($zone_info as $key=>$val)
                <div class="form-group">
                    <label>战区名称</label>
                    <input type="text" placeholder="请输入战区名称" name="zone_name" value="{{ $val->zone_name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>包含省份</label>
                    <div style="clear: both;"></div>
                    <select data-placeholder="请选择省份" name="province_id[]" class="chosen-select2" multiple style="width:350px;" tabindex="2">
                        {{--所有战区当前选中的战区--}}
                        @foreach($val->province as $kk=>$vv)
                            <option selected="selected" value="{{ $vv->id }}">{{ $vv->province_name }}</option>
                        @endforeach
                        {{--所有战区当前选中的战区--}}
                        {{--所有战区未选中的战区--}}
                        @foreach($new_province_name as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                        {{--所有战区未选中的战区--}}
                    </select>
                    <div style="clear: both;"></div>
                </div>
                @endforeach
                <div class="form-group">
                    <label>安全密码</label>
                    <input type="text" placeholder="请输入安全密码" name="safe_password" value="" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="return postForm();">保存</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
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
<form method="post" role="form" id="currentForm" action="{{ url('tooling/ajax/package_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                套餐编辑
            </div>
            <div class="modal-body">

                <div class="form-group"><label class="col-sm-2 control-label">套餐名称</label>
                    <div class="col-sm-10"><input type="text" name="package_name" value="{{ $val->package_name }}" class="form-control"></div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">套餐价格</label>
                    <div class="col-sm-10"><input type="text"  name="package_price" class="form-control"></div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">关联程序系统</label>
                    <div class="col-sm-10">
                        <select data-placeholder="选择关联系统" name="program_ids[]" class="chosen-select" multiple style="width:350px;" tabindex="4">
                            @foreach($list as $key=>$val)
                                <option value="{{ $val->id }}">{{ $val->program_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="clear: both;"></div>
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
<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/warzone_add_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                添加战区
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>战区名称</label>
                        <input type="text" placeholder="请输入战区名称" name="zone_name" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>包含省份</label>
                        <div style="clear: both;"></div>
                        <select data-placeholder="请选择省份" name="province_id[]" class="chosen-select2" multiple style="width:350px;" tabindex="2">
                            {{--所有战区未选中的战区--}}
                            @foreach($province as $k=>$v)
                                <option value="{{$v->id}}">{{$v->province_name}}</option>
                            @endforeach
                            {{--所有战区未选中的战区--}}
                        </select>
                        <div style="clear: both;"></div>
                    </div>
                <div class="form-group">
                    <label>安全密码</label>
                    <input type="password" placeholder="请输入安全密码" name="safe_password" value="" class="form-control">
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
    $(document).ready(function() {

        $('.chosen-select2').chosen({width:"100%"});
        $('.chosen-select').chosen({width:"100%"});
        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('.gg').chosen();
        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#deleteBtn').click(function(){
            swal({
                title: "温馨提示",
                text: "删除成功",
                type: "success"
            });
        });
        $('#deleteBtn2').click(function(){
            swal({
                title: "温馨提示",
                text: "删除失败,您没有操作权限",
                type: "error"
            });
        });
        $('#addBtn').click(function(){
            $('#myModal').modal();
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
<link href="{{asset('public/Zerone/library/chosen')}}/css/chosen.css" rel="stylesheet">
<link href="{{asset('public/Zerone/library')}}/switchery/css/switchery.css" rel="stylesheet">
<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/agent_list_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h3>“刘记新科技有限公司”商户划入</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" style="padding-top: 7px;">请选择商户</label>
                    <div class="col-sm-9">
                        <select data-placeholder="请选择省份" class="chosen-select" style="width:350px;" tabindex="4">
                            <option value="Mayotte">刘记集团</option>
                            <option value="Mexico">李记鸡煲连锁</option>
                            <option value="Micronesia, Federated States of">叶记猪肚鸡</option>
                            <option value="Moldova, Republic of">韦记莲藕汤</option>
                        </select>
                    </div>

                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" style="padding-top: 7px;">消耗程序与分店数量</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="js-switch" checked  value="1"/>
                    </div>

                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">安全密码</label>
                    <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary saveBtn">保存</button>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
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
                console.log(json);
//                swal({
//                    title: "提示信息",
//                    text: json.data,
//                    confirmButtonColor: "#DD6B55",
//                    confirmButtonText: "确定",
//                    //type: "warning"
//                });
            }
        });
    }
</script>
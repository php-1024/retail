<link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/proxy_examine_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{$info->id}}">
    <input type="hidden" name="sta" id="sta" value="{{$sta}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h3>编辑服务商</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">所在战区</label>
                    <div class="col-sm-10">
                        <select class="form-control m-b" name="account">
                            <option>东部战区</option>
                            <option>西部战区</option>
                            <option>南部战区</option>
                            <option>北部战区</option>
                            <option>中部战区</option>
                        </select>
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">服务商名称</label>
                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">负责人姓名</label>
                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">负责人身份证号</label>
                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">手机号码</label>
                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">服务商登陆密码</label>
                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">安全密码</label>
                    <div class="col-sm-10"><input type="text" class="form-control" value=""></div>
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
<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/agent_fansmanage_add_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="organization_id" value="{{$data->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h3>“{{$data->organization_name}}”商户划入</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" style="padding-top: 7px;">请选择商户</label>
                    <div class="col-sm-9">
                        <select data-placeholder="请选择省份" class="chosen-select" style="width:350px;" tabindex="4" name="fansmanage_id">
                            @foreach($list as $key=>$value)
                            <option value="{{$value->id}}">{{$value->organization_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" style="padding-top: 7px;">是否消耗程序</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="js-switch" checked  value="1" name="status"/>
                    </div>

                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">安全密码</label>
                    <div class="col-sm-9"><input type="password" class="form-control" value="" name="safe_password"></div>
                </div>
                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary saveBtn" onclick="postForm()">保存</button>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script>
    $(document).ready(function() {
        $('.chosen-select').chosen({width:"100%",no_results_text:'对不起，没有找到结果！关键词：'});
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });
        var elem = document.querySelector('.js-switch2');
        var switchery = new Switchery(elem, { color: '#1AB394' });
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
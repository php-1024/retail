<div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <h3>添加店铺</h3>
        </div>
        <div class="modal-body">
            <form method="post" id="currentForm" action="{{ url('zerone/ajax/store_insert_check') }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="program_id" value="{{$program_id}}">
            <div class="form-group">
                <label class="col-sm-3 control-label">程序名称</label>
                <div class="col-sm-9"><input type="text" readonly class="form-control" value="{{$program_name}}"></div>
            </div>

            <div style="clear:both"></div>
            <div class="hr-line-dashed"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top: 7px;">商户名称</label>
                <div class="col-sm-9">
                    <select data-placeholder="请选择省份" class="chosen-select" style="width:350px;" tabindex="4">
                        @foreach($listOrg as $key=>$value)
                        <option value="{{$value->id}}">{{$value->organization_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">店铺名称</label>
                    <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">允许开设分店数量</label>
                    <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
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
                    <label class="col-sm-3 control-label">负责人姓名</label>
                    <div class="col-sm-9"><input type="text" class="form-control" value=""></div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label">店铺管理账号</label>--}}
                    {{--<div class="col-sm-9"><input type="text" readonly class="form-control" value="1321321321"></div>--}}
                {{--</div>--}}

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">店铺登录密码</label>
                    <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
                </div>

                <div style="clear:both"></div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">重复登录密码</label>
                    <div class="col-sm-9"><input type="password" class="form-control" value=""></div>
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
                <button type="button" class="btn btn-primary saveBtn" onclick="postForm()">保存</button>
            </div>
            </form>
        </div>
    </div>
</div>
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
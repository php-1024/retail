<form class="form-horizontal tasi-form" method="post" id="currentForm" action="{{ url('fansmanage/ajax/auto_reply_delete_check') }}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{$id}}">
    <input type="hidden" name="media_id" id="media_id" value="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">删除关键字</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 text-right">安全密码</label>
                    <div class="col-sm-10">
                        <input type="password" value="" class="form-control" name="safepassword">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn" onclick="return postForm();">确定</button>
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
                    confirmButtonText: "确定"
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定"
                });
            }
        });
    }
</script>
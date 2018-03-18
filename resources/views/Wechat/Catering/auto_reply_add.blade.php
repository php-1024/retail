<form class="form-horizontal tasi-form" method="post" id="currentForm" action="{{ url('api/ajax/auto_reply_add_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">添加关键字</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 text-right">关键字</label>
                        <div class="col-sm-10">
                            <input type="text" value="" name="keyword" placeholder="请输入关键字" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">适配类型</label>
                        <div class="col-sm-10">
                            <div class="radio col-sm-2">
                                <label>
                                    <input type="radio" name="type" id="optionsRadios2" checked="" value="2">
                                    精确

                                </label>
                            </div>
                            <div class="radio col-sm-2">
                                <label>
                                    <input type="radio" name="type" id="optionsRadios2" value="1">
                                    模糊
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn">确定</button>
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
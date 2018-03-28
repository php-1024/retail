<form class="form-horizontal" id="wechat_conditional_menu_add_check" method="post" action="{{url('fansmanage/ajax/wechat_conditional_menu_add_check')}}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" name="tag_id" id="_token" value="{{$tag_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">安全密码</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="safe_password" value="">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" onclick="DeleteCategory()">确定</button>
            </div>
        </div>
    </div>
</form>

<script>
    function DeleteCategory(){
        var target = $("#wechat_conditional_menu_add_check");
        var url = target.attr("action");
        var data = target.serialize();
        $.post(url,data,function(json){
            if(json.status=='-1'){
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                console.log(json);
//                swal({
//                    title: "提示信息",
//                    text: json.data,
//                    confirmButtonColor: "#DD6B55",
//                    confirmButtonText: "确定",
//                },function(){
//                    window.location.reload();
//                });
            }
        });
    }
</script>
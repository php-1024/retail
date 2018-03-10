 <form method="post" class="form-horizontal"  role="form" id="spec_item_add_check" action="{{ url('branch/ajax/spec_item_add_check') }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="goods_id" value="{{$goods->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加子规格</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-id-1">子规格名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="spec_item_name" value="">
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
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
                    <button class="btn btn-success" type="button" onclick="spec_item_add()">确定</button>
                </div>
            </div>
        </div>
    </form>
<script>
    //添加子规格提交
    function spec_item_add(spec_id) {
        alert(spec_id);
        var target = $("#spec_item_add");
        var url = target.attr("action");
        var token = $('#_token').val();
        var data = {'id':id,'account':account,'status':status,'_token':token};



        if(id==''){
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            },function(){
                window.location.reload();
            });
            return;
        }


        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>
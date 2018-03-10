 <form method="post" class="form-horizontal"  role="form" id="spec_item_add_check" action="{{ url('branch/ajax/spec_item_add_check') }}">
     <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
     <input type="hidden" name="goods_id" id="goods_id" value="{{$id}}">
     <input type="hidden" name="spec_id" value="{{$spec_id}}">
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
                    <button class="btn btn-success" type="button" onclick="spec_item_add_check()">确定</button>
                </div>
            </div>
        </div>
    </form>
<script>
    //添加子规格提交
    function spec_item_add_check() {
        var target = $("#spec_item_add_check");
        var url = target.attr("action");
        var data = target.serialize();
        var token = $('#_token').val();
        var goods_id = $('#goods_id').val();
        $.post(url, data, function (json) {
            if (json.status == -1) {
                window.location.reload();
            } else if(json.status == 1) {
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(json){
                    //规格添加成功后异步刷新规格部分
//                    alert('添加子规格类成功！');
//                    $('#spec_content').html(json);
//                    $('#spec_content').modal();
//                    window.location.reload();

                    $.ajax({
                        url:'{{url('branch/ajax/goods_spec')}}',//你对数据库的操作路径
                        data:{//这是参数
                            _token:token,
                            goods_id:goods_id,
                        },
                        type:'post',//提交方式
                        success:function(data){//后台处理数据成功后的回调函数
                            alert('ok');
                            $("#spec_content").html(data);
                        },
                        error:function(data){//后台处理数据失败后的回调函数
                            alert('error');
                            //   alert(data)
                        }
                    })

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


//        $.post(url,data,function(response){
//            if(response.status=='-1'){
//                swal({
//                    title: "提示信息",
//                    text: response.data,
//                    confirmButtonColor: "#DD6B55",
//                    confirmButtonText: "确定",
//                },function(){
//                    window.location.reload();
//                });
//                return;
//            }else{
//                $('#spec_content').html(response);
//                $('#spec_content').modal();
//            }
//        });
    }
</script>
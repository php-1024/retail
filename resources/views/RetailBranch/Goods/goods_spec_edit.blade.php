<form method="post" class="form-horizontal"  role="form" id="spec_edit_check" action="{{ url('cateringbranch/ajax/spec_edit_check') }}">
     <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
     <input type="hidden" name="spec_id" value="{{$spec_id}}">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">编辑规格</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" method="get">
                     <div class="form-group">
                         <label class="col-sm-2 control-label" for="input-id-1">规格名称</label>
                         <div class="col-sm-10">
                             <input type="text" class="form-control" name="spec_name" value="{{$spec->name}}">
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
                 <button class="btn btn-success" type="button" onclick="spec_edit_check()">确定</button>
             </div>
         </div>
     </div>
 </form>
<script>
    //添加子规格提交
    function spec_edit_check() {
        var target = $("#spec_edit_check");
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
                },function(){
                    //规格添加成功后异步刷新规格部分
                    $.ajax({
                        url:'{{url('cateringbranch/ajax/goods_spec')}}',//你对数据库的操作路径
                        data:{
                            _token:token,
                            goods_id:goods_id,
                        },
                        type:'post',
                        success:function(data){
                            $("#spec_content").html(data);
                            $('#myModal').modal('hide');
                        },
                        error:function(){
                            alert('添加出错，请稍后再试！');
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
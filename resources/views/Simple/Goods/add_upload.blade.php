<form class="form-horizontal" id="goods_thumb_delete_check" method="post" action="http://develop.01nnt.com/simple/ajax/goods_thumb_delete_check">
    <input type="hidden" name="_token" id="_token" value="AIiLDFIqNngDpCzeDAbGnFP4gVVSztpJdBx6mZhG">
    <input type="hidden" name="goods_thumb_id" id="goods_thumb_id" value="4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">添加商品图片》》商品图片列表</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    @foreach($thumb as $key=>$val)
                        <div class="col-sm-2">
                        <img src="http://develop.01nnt.com/uploads/simple/20180425104330148.jpg" style="width: 100px; height: 100px;" onclick="bigthumb(this.src)">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" onclick="DeleteGoodsThumb()">确定</button>
            </div>
        </div>
    </div></form>



<script>
    function editDisplayorder(id,obj){
        var url = $('#thumb_edit_displayorder_url').val();
        var token = $('#_token').val();
        var displayorder = $(obj).val();

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

        var data = {'id':id,'displayorder':displayorder,'_token':token};
        $.post(url,data,function(response){
            if(response.status!='1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    //window.location.reload();
                });
            }else{
                swal({
                    title: "温馨提示",
                    text: response.data,
                    type: "success"
                });
            }

        });
    }
</script>


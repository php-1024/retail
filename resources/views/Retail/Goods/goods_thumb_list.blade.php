<div class="table-responsive">
    <form class="form-horizontal" method="get">
        <input type="hidden" id="goods_thumb_delete_comfirm_url" value="{{ url('retail/ajax/goods_thumb_delete') }}">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    </form>
    <table class="table table-bordered table-stripped">
        <thead>
        <tr>
            <th>
                图片预览
            </th>
            <th>
                图片链接
            </th>
            <th>
                图片排序
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods_thumb as $key=>$val)
        <tr>
            <td>
                <img src="{{asset('/')}}{{$val->thumb}}" style="width: 50px; height: 50px;">
            </td>
            <td>
                {{asset('/'.$val->thumb)}}
            </td>
            <td>
                <input type="text" name="displayorder" size="3" value="{{$val->displayorder}}" />
            </td>
            <td>
                <button type="button" id="deleteBtn" class="btn btn-danger btn-xs" onclick="getDeleteForm({{ $val->id }})"><i class="fa fa-times"></i></button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="line line-dashed b-b line-lg pull-in"></div>
    <div class="form-group">
        <div class="col-sm-12 col-sm-offset-6">
            <button type="button" class="btn btn-success" id="addBtn">保存信息</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#deleteBtn').click(function(){
            $('#myModal').modal();
        });
        $('#save_btn').click(function(){
            swal({
                title: "温馨提示",
                text: "操作成功",
                type: "success"
            });
        });
    });
    //删除商品信息
    function getDeleteForm(id){
        var url = $('#goods_thumb_delete_comfirm_url').val();
        var token = $('#_token').val();
        var data = {'_token':token,'id':id};
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
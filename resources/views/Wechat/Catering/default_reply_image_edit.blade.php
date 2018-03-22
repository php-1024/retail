<form class="form-horizontal tasi-form" method="post" id="currentForm" action="{{ url('api/ajax/default_reply_image_edit_check') }}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" name="media_id" id="media_id" value="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">选择图片素材</h4>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    @foreach($list as $key=>$val)
                        <div class="col-lg-2">
                            <div class="item" data-id="{{$val->id}}" onclick="select_img(this)" data-media_id="{{$val->media_id}}">
                                <div class="pos-rlt">
                                    <div class="item-overlay opacity bg-black" style="height: 100px; width: 100px; @if($info['image_media_id']==$val['media_id']) display:block;@endif">
                                        <div class="text-info padder m-t-sm text-sm">
                                            <i class="fa fa-check text-success"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:;"><img  src="{{asset('uploads/wechat/'.$val['organization_id'].'/'.$val->filename)}}" alt="" style="height: 100px; width: 100px;"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
    function select_img(obj){
        var target = $(obj);
        var media_id = target.data('media_id');
        $('#media_id').val(media_id);
        $('.item').find('.item-overlay').hide();
        target.find('.item-overlay').show();
    }
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
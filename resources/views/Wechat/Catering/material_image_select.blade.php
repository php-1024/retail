<form class="form-horizontal tasi-form" method="get">
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
                            <div class="item">
                                <div class="pos-rlt">
                                    <a href="javascript:;"><img data-id="{{$val->id}}" onclick="select_img(this,'{{$i}}')" data-media_id="{{$val->media_id}}" src="{{asset('uploads/wechat/'.$val['organization_id'].'/'.$val->filename)}}" alt="" style="height: 100px; width: 100px;"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
            </div>
        </div>
    </div>
</form>
<script>
    function select_img(obj,i){
        var id = $(obj).attr('data-id');
        var media_id = $(obj).attr('data-media_id');
        var url = $(obj).attr('src');

        $('#img_show_'+i).attr('src',url).show();
        $('#media_id_'+i).attr('media',url).show();
        $('#img_id_'+i).attr('media',url).show();
    }
</script>
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
                                    <a href="javascript:;"><img src="{{asset('uploads/wechat/'.$val['organization_id'].'/'.$val->filename)}}" alt="" style="height: 100px; width: 100px;"></a>
                                </div>
                                <div class="padder-v">
                                    <span>{{ $val->filename }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn">确定</button>
            </div>
        </div>
    </div>
</form>
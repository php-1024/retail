<link rel="stylesheet" href="{{asset('public/Catering')}}/trumbowyg/design/css/trumbowyg.css">
<form class="form-horizontal tasi-form" method="post" id="currentForm" action="{{ url('api/ajax/default_reply_text_edit_check') }}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="@if(!empty($info)){{$info['id']}}@endif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">文本回复</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <textarea id="form-content" class="editor" name="text_info" cols="30" rows="10">@if(!empty($info)){{$info['text_info']}}@endif</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn" onclick="return postForm();">确定</button>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/Catering')}}/trumbowyg/trumbowyg.js"></script>
<script src="{{asset('public/Catering')}}/trumbowyg/plugins/upload/trumbowyg.upload.js"></script>
<script src="{{asset('public/Catering')}}/trumbowyg/plugins/base64/trumbowyg.base64.js"></script>
<script>
    $(function(){
        $('#form-content').trumbowyg({
            lang: 'fr',
            closable: false,
            mobile: true,
            fixedBtnPane: true,
            fixedFullWidth: true,
            semantic: true,
            resetCss: true,
            autoAjustHeight: true,
            autogrow: true
        });
    });
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
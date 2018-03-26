<form class="form-horizontal tasi-form" method="post" id="currentForm" action="{{ url('api/ajax/default_reply_article_edit_check') }}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" name="media_id" id="media_id" value="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">选择图文素材</h4>
            </div>
            <div class="modal-body">
                <section class="panel panel-default">
                    <header class="panel-heading">
                        图文素材列表
                    </header>

                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>

                                <th>素材标题</th>
                                <th>素材类型</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $key=>$val)
                                <tr>
                                    <td>{{$val->title}}</td>
                                    <td>
                                        @if($val->type == '1')
                                            单条图文
                                        @else
                                            多条图文
                                        @endif
                                    </td>
                                    <td>{{$val->created_at}}</td>
                                    <td>
                                        <button data-id="{{$val->id}}" data-media_id="{{$val->media_id}}" onclick="return select_article(this);" class="btn @if($info['article_media_id']==$val['media_id']) btn-success @else btn-info @endif btn-xs choose_btn" type="button"><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;选择</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn" onclick="return postForm();">确定</button>
            </div>
        </div>
    </div>
</form>
<script>
    function select_article(obj){
        var target = $(obj);
        var media_id = target.data('media_id');
        $('#media_id').val(media_id);
        $('.choose_btn').removeClass('btn-success').addClass('btn-info');
        $(obj).removeClass('btn-info').addClass('btn-success');

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
<link href="{{asset('public/Zerone/library/iCheck')}}/css/custom.css" rel="stylesheet">
<form method="post" role="form" id="currentForm" action="{{ url('zerone/ajax/company_list_edit_check') }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value="{{$listorg->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">程序划入</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal tasi-form" method="get">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商户名称</label>
                            <div class="col-sm-9">
                                <input type="text" value="刘记鸡煲王" placeholder="商户名称" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">套餐名称</label>
                            <div class="col-sm-9">
                                <input type="text" value="零壹科技餐饮系统" placeholder="套餐名称" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">零壹新科技餐饮总店系统</label>
                            <div class="col-sm-2">
                                <input type="text" value="0" class="form-control" >
                            </div>
                            <label class="col-sm-2 control-label">套</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">零壹新科技餐饮店铺系统</label>
                            <div class="col-sm-2">
                                <input type="text" value="0"  class="form-control">
                            </div>
                            <label class="col-sm-2 control-label">套</label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">安全密码</label>
                            <div class="col-sm-9">
                                <input type="password" value="" placeholder="安全密码" class="form-control" >
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-success" type="button" id="save_btn">确定</button>
                </div>
            </div>
        </div>
    </form>
<script src="{{asset('public/Zerone/library/iCheck')}}/js/icheck.min.js"></script>
<script>
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
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title: "提示信息",
                    text: json.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    //type: "warning"
                });
            }
        });
    }
</script>
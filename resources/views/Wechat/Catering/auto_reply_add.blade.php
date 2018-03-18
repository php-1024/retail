<form class="form-horizontal tasi-form" method="get">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">添加关键字</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 text-right">关键字</label>
                        <div class="col-sm-10">
                            <input type="text" value="刘记鸡煲王" placeholder="店铺名称" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">适配类型</label>
                        <div class="col-sm-10">
                            <div class="radio col-sm-2">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" checked="" value="option2">
                                    模糊
                                </label>
                            </div>
                            <div class="radio col-sm-2">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    精确
                                </label>
                            </div>
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
<form class="form-horizontal tasi-form" method="get">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">订单详情</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 text-right">订单编号</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$order->ordersn}}" class="form-control" disabled="" name="ordersn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">类型</label>
                        <div class="col-sm-10">
                            <input type="text" value="@if($order->type == 1)进货@elseif($order->type == 2)退货@else未知@endif" class="form-control" disabled="" name="type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">供应商</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$order->RetailSupplier->company_name}}" class="form-control" disabled="" name="company_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">供应商联系方式</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$order->RetailSupplier->contactmobile}}" class="form-control" disabled="" name="contactmobile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">经手操作人员</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$order->operator_id}}" class="form-control" disabled="" name="operator_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">订单金额</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$order->order_price}}" class="form-control" disabled="" name="order_price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">开单时间</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$order->created_at}}" class="form-control" disabled="" name="created_at">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>会员卡名称</th>
                            <th>适用店铺范围</th>
                            <th>适用商品范围</th>
                            <th>折扣率</th>
                            <th>余额</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>钻石会员卡</td>
                            <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                            <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                            <td>0.9</td>
                            <td>10000.00元</td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>钻石会员卡</td>
                            <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                            <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                            <td>0.9</td>
                            <td>10000.00元</td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>钻石会员卡</td>
                            <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                            <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                            <td>0.9</td>
                            <td>10000.00元</td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>钻石会员卡</td>
                            <td><button type="button" data-original-title="适用分店" data-content="所有分店" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">4个分店</button></td>
                            <td><label class="label label-success">所有</label>&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs" id="listBtn"><i class="fa fa-list"></i>&nbsp;&nbsp;查看列表</button></td>
                            <td>0.9</td>
                            <td>10000.00元</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-success" type="button" id="save_btn">确定</button>
            </div>
        </div>
    </div>
</form>
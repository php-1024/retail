<?php
/**
 * Android接口
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Organization;
use App\Models\RetailCategory;
use App\Models\RetailConfig;
use App\Models\RetailGoods;
use App\Models\RetailGoodsThumb;
use App\Models\RetailOrder;
use App\Models\RetailOrderGoods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class AndroidApiController extends Controller{
    /**
     * 登入检测
     */
    public function login(Request $request){
        $account = $request->account;//登入账号
        $password = $request->password;//登入密码
        $data = Account::where([['account',$account]])->orWhere([['mobile',$account]])->first();//根据账号进行查询
        if(empty($data)){
            return response()->json(['msg' => '用户不存在', 'status' => '0','data'=>'']);
        }
        $key = config("app.retail_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        if($encryptPwd != $data['password']){
            return response()->json(['msg' => '密码不正确', 'status' => '0']);
        }
        $data = ['status' => '1', 'msg' => '登陆成功', 'data' => ['account_id' => $data['id'], 'account' => $data['account'], 'organization_id' => $data['organization_id'], 'uuid' => $data['uuid']]];
        return response()->json($data);
    }

    /**
     * 商品分类接口
     */
    public function goodscategory(Request $request){
        $organization_id = $request->organization_id;//店铺id
        $categorylist = RetailCategory::getList([['fansmanage_id',$organization_id]],'0','displayorder','asc',['id','name','displayorder']);
        $data = ['status' => '1', 'msg' => '获取分类成功', 'data' => ['categorylist' => $categorylist]];
        return response()->json($data);
    }

    /**
     * 商品列表接口
     */
    public function goodslist(Request $request){
        $organization_id = $request->organization_id;//店铺id
        $keyword = $request->keyword;//关键字
        $scan_code = $request->scan_code;//条码
        $where = [['fansmanage_id',$organization_id]];
        if($keyword){
            $where =[['keywords','LIKE','%'.$keyword.'%']];
        }
        if($scan_code){
            $where =[['barcode',$scan_code]];
        }
        $goodslist = RetailGoods::getList($where,'0','displayorder','asc',['id','name','category_id','details','price','stock']);
        foreach($goodslist as $key=>$value){
            $goodslist[$key]['category_name']=RetailCategory::getPluck([['id',$value['category_id']]],'name')->first();
            $goodslist[$key]['thumb']=RetailGoodsThumb::where([['goods_id',$value['id']]])->select('thumb')->get();
        }
        $data = ['status' => '1', 'msg' => '获取分类成功', 'data' => ['goodslist' => $goodslist]];
        return response()->json($data);
    }

    /**
     * 商品列表接口
     */
    public function order_check(Request $request){
        $organization_id = $request->organization_id;//店铺id
        $user_id = $request->user_id;//用户id 散客为0
        if(!$user_id){
            $user_id = 0;
        }
        $account_id = $request->account_id;//操作员id
        $remarks = $request->remarks;//备注
        $order_type = $request->order_type;//订单类型
        if(!$order_type){
            $order_type =1;
        }
        $goodsdata = json_decode($request->goodsdata,TRUE);//商品数组
        $order_price = 0;
        foreach($goodsdata as $key=>$value){
            foreach($value as $k=>$v){
                $order_price += $v['price'];
            }
        }
        $fansmanage_id = Organization::getPluck([['id',$organization_id]],'parent_id')->first();
        $num = RetailOrder::where([['retail_id',$organization_id],['ordersn','LIKE','%'.date("Ymd",time()).'%']])->count();//查询订单今天的数量
        $num += 1;
        $sort = 100000 + $num;
        $ordersn ='LS'.date("Ymd",time()).'_'.$organization_id.'_'.$sort;
        $orderData = [
            'ordersn' => $ordersn,
            'order_price' => $order_price,
            'remarks' => $remarks,
            'order_type' => $order_type,
            'fansmanage_id' => $fansmanage_id,
            'retail_id' => $organization_id,
            'user_id' => $user_id,
            'operator_id' => $account_id,
            'status' => '0',
        ];
        $config = RetailConfig::getPluck([['retail_id',$organization_id],['cfg_name','allow_zero_stock']],'cfg_value')->first();//查询是否可零库存开单
        DB::beginTransaction();
        try{
            $order_id = RetailOrder::addRetailOrder($orderData);
            foreach($goodsdata as $key=>$value){
                foreach($value as $k=>$v){
                    $onedata = RetailGoods::getOne([['id',$v['id']]]);//查询商品库存数量
                    $thumb=RetailGoodsThumb::getPluck([['goods_id',$v['id']]],'thumb')->first();//商品图片一张
                    if($config != '1'){
                        if($onedata['stock'] - $v['num'] < 0){
                            return response()->json(['msg' => '商品'.$onedata['name'].'库存不足', 'status' => '0', 'data' => '']);
                        }
                    }
                    $data = [
                        'order_id'=>$order_id,
                        'goods_id'=>$v['id'],
                        'title'=>$onedata['name'],
                        'thumb'=>$thumb,
                        'details'=>$onedata['details'],
                        'total'=>$v['num'],
                        'price'=>$v['price'],
                    ];
                    RetailOrderGoods::addOrderGoods($data);//添加商品快照

                    $power = RetailConfig::getPluck([['retail_id',$organization_id],['cfg_name','allow_around_stock']],'cfg_value')->first();//查询是开单前减库存还是单后
                    if($power != '1') {
                        $stock = $onedata['stock'] - $v['num'];
                        RetailGoods::editRetailGoods([['id', $v['id']]], ['stock' => $stock]);//修改商品库存
                    }
                }
            }

            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['msg' => '提交订单失败', 'status' => '0', 'data' => '']);
        }
        return response()->json(['status' => '1', 'msg' => '提交订单成功', 'data' => ['order_id' => $order_id]]);
    }

//account_id=76&organization_id=5&timestamp=1522485361983&token=e71eaa006f6854ca6c86380a7e94e853&goodsdata={"data":[{"id":1,"num":"1","price":"10.00"},{"id":2,"num":"1","price":"12.00"}]}


    /**
     * 取消订单接口
     */
    public function cancel_order(Request $request){
        $order_id = $request->order_id;//订单id
        $organization_id = $request->organization_id;//店铺
        $power = RetailConfig::getPluck([['retail_id',$organization_id],['cfg_name','allow_around_stock']],'cfg_value')->first();//查询是否可零库存开单
        DB::beginTransaction();
        try{
            if($power != '1'){
                $list = RetailOrderGoods::where([['order_id',$order_id]])->get();//查询订单快照里的商品信息
                foreach($list as $key=>$value){
                    $goods = RetailGoods::getOne([['id',$value['goods_id']]]);//查询现在商品的信息
                    $num = $goods['stock'] + $value['total'];//把库存加回去
                    RetailGoods::editRetailGoods([['id',$value['goods_id']]],['stock'=>$num]);//修改库存
                }
            }
            RetailOrder::editRetailOrder([['id',$order_id]],['status'=>'-1']);
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['msg' => '取消订单失败', 'status' => '0', 'data' => '']);
        }
        return response()->json(['status' => '1', 'msg' => '取消订单成功', 'data' => ['order_id' => $order_id]]);
    }

    /**
     * 订单列表接口
     */
    public function order_list(Request $request){
        $organization_id = $request->organization_id;//店铺
        $status = $request->status;//订单状态
        $where = [['retail_id',$organization_id]];
        if($status){
            $where = [['status',$status]];
        }
        $orderlist = RetailOrder::getList($where,'0','id','',['id','ordersn','order_price','status','created_at'])->toArray();
        if($orderlist){
            $total_num = count($orderlist);//订单数量
            $total_amount = 0;
            foreach($orderlist as $key=>$value){
                $total_amount +=$value['order_price'];//订单总价格
            }
        }else{
            return response()->json(['status' => '0', 'msg' => '没有订单', 'data' => '']);
        }

        $data = [
            'orderlist'=>$orderlist,
            'total_num'=>$total_num,
            'total_amount'=>$total_amount,
            ];
        return response()->json(['status' => '1', 'msg' => '订单列表查询成功', 'data' => $data]);
    }

    /**
     * 订单详情接口
     */
    public function order_detail(Request $request){
        $organization_id = $request->organization_id;//店铺
        $order_id = $request->order_id;//订单id

        $orderdata = RetailOrder::getOne([['id',$order_id],['retail_id',$organization_id]])->toArray();
        $ordergoods = $orderdata['retail_order_goods'];
        unset($orderdata['updated_at']);
        unset($orderdata['deleted_at']);
        unset($orderdata['user']);
        unset($orderdata['retail_order_goods']);
        print_r($orderdata);

//        $data = [
//            'orderlist'=>$orderlist,
//            'total_num'=>$total_num,
//            'total_amount'=>$total_amount,
//        ];
//        return response()->json(['status' => '1', 'msg' => '订单列表查询成功', 'data' => $data]);
    }



    /**
     * 现金支付接口
     */
    public function cash_payment(Request $request){
        $order_id = $request->order_id;//订单id
        $organization_id = $request->organization_id;//店铺
        $paytype = $request->paytype;//支付方式
        $power = RetailConfig::getPluck([['retail_id',$organization_id],['cfg_name','allow_around_stock']],'cfg_value')->first();//查询是开单前减库存还是开单后
        DB::beginTransaction();
        try{
            if($power){
                $list = RetailOrderGoods::where([['order_id',$order_id]])->get();//查询订单快照里的商品信息
                foreach($list as $key=>$value){
                    $goods = RetailGoods::getOne([['id',$value['goods_id']]]);//查询现在商品的信息
                    $num = $goods['stock'] - $value['total'];//减库存
                    RetailGoods::editRetailGoods([['id',$value['goods_id']]],['stock'=>$num]);//修改库存
                }
            }
            RetailOrder::editRetailOrder([['id',$order_id]],['paytype'=>$paytype,'status'=>'1']);
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['msg' => '现金付款失败', 'status' => '0', 'data' => '']);
        }
        return response()->json(['status' => '1', 'msg' => '现金付款成功', 'data' => ['order_id' => $order_id]]);
    }

    /**
     * 其他支付方式接口
     */
    public function other_payment(Request $request){
        $order_id = $request->order_id;//订单id
        $organization_id = $request->organization_id;//店铺
        $paytype = $request->paytype;//支付方式
        $power = RetailConfig::getPluck([['retail_id',$organization_id],['cfg_name','allow_around_stock']],'cfg_value')->first();//查询是开单前减库存还是开单后
        DB::beginTransaction();
        try{
            if($power){
                $list = RetailOrderGoods::where([['order_id',$order_id]])->get();//查询订单快照里的商品信息
                foreach($list as $key=>$value){
                    $goods = RetailGoods::getOne([['id',$value['goods_id']]]);//查询现在商品的信息
                    $num = $goods['stock'] - $value['total'];//减库存
                    RetailGoods::editRetailGoods([['id',$value['goods_id']]],['stock'=>$num]);//修改库存
                }
            }

            RetailOrder::editRetailOrder([['id',$order_id]],['paytype'=>$paytype,'status'=>'1']);
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['msg' => '现金付款失败', 'status' => '0', 'data' => '']);
        }
        return response()->json(['status' => '1', 'msg' => '现金付款成功', 'data' => ['order_id' => $order_id]]);
    }
}
?>
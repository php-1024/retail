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
use App\Models\RetailShengpay;
use App\Models\RetailShengpayTerminal;
use App\Models\RetailStock;
use App\Models\RetailStockLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class WechatApiController extends Controller
{
    /**
     * 登入检测
     */
    public function login(Request $request)
    {
        // 登入账号
        $account = $request->account;
        // 登入密码
        $password = $request->password;
        // 商户号
        $sft_pos_num = $request->sft_pos_num;
        // pos机终端号
        $terminal_num = $request->terminal_num;
        // 根据账号进行查询
        $data = Account::where([['account', $account]])->orWhere([['mobile', $account]])->first();
        if (empty($data)) {
            return response()->json(['msg' => '用户不存在', 'status' => '0', 'data' => '']);
        }
        //检查该账号是否被冻结
        if ($data->status == '0') {
            return response()->json(['msg' => '对不起该账号已经被冻结！', 'status' => '0', 'data' => '']);
        }
        // 获取加密盐
        $key = config("app.retail_encrypt_key");
        // 加密密码第一重
        $encrypted = md5($password);
        // 加密密码第二重
        $encryptPwd = md5("lingyikeji" . $encrypted . $key);
        if ($encryptPwd != $data['password']) {
            return response()->json(['msg' => '密码不正确', 'status' => '0', 'data' => '']);
        }
        // 查询pos商户号
        $shengpay = RetailShengpay::getOne([['retail_id', $data['organization_id']], ['sft_pos_num', $sft_pos_num]]);
        if (empty($shengpay)) {
            return response()->json(['msg' => 'pos商户号不存在', 'status' => '0', 'data' => '']);
        }
        if ($shengpay->status != '1') {
            return response()->json(['msg' => 'pos商户号没通过审核', 'status' => '0', 'data' => '']);
        }
        // 查询pos机终端号
        $terminal = RetailShengpayTerminal::getOne([['retail_id', $data['organization_id']], ['terminal_num', $terminal_num]]);
        if (empty($terminal)) {
            return response()->json(['msg' => 'pos机终端号不存在', 'status' => '0', 'data' => '']);
        }
        if ($terminal->status != '1') {
            return response()->json(['msg' => 'pos机终端号没通过审核', 'status' => '0', 'data' => '']);
        }
        // 店铺名称
        $organization_name = Organization::getPluck([['id', $data['organization_id']]], 'organization_name');
        //用户昵称
        $account_realname = AccountInfo::getPluck([['account_id', $data['id']]], 'realname')->first();
        // 数据返回
        $data = ['status' => '1', 'msg' => '登陆成功', 'data' => ['account_id' => $data['id'], 'account' => $data['account'], 'realname' => $account_realname, 'organization_id' => $data['organization_id'], 'uuid' => $data['uuid'], 'sft_num' => $shengpay['sft_num'], 'organization_name' => $organization_name]];

        return response()->json($data);
    }
}

?>
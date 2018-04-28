<?php
/**
 * module_node表的模型
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $table = 'address';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    protected $guarded = [];



    //获取多条信息
    public static function getList($where)
    {
        return self::where($where)->get();
    }

    //获取多条信息
    public static function getOne($where)
    {
        return self::where($where)->first();
    }


    //添加数据
    public static function addAddress($param)
    {
        $organization = new Address();//实例化程序模型

        $organization->organization_name = $param['organization_name'];//组织名称
        $organization->parent_id = $param['parent_id'];//多级组织的关系
        $organization->parent_tree = $param['parent_tree'];//上级程序
        $organization->program_id = $param['program_id'];//组织关系树
        $organization->asset_id = $param['asset_id'];//下级组织使用程序id（商户使用）
        $organization->type = $param['type'];//类型 2为服务商
        $organization->status = $param['status'];//状态 1-正常 0-冻结
        $organization->save();
        return $organization->id;
    }

    //修改数据
    public static function editAddress($where, $param)
    {
        $model = self::where($where)->first();
        foreach ($param as $key => $val) {
            $model->$key = $val;
        }
        $model->save();
    }

    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where)
    {
        $row = self::getPluck($where, 'id');
        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    //获取单行数据的其中一列
    public static function getPluck($where, $pluck)
    {
        return self::where($where)->value($pluck);
    }

    //获取分页数据-分店
    public static function getstore($where, $paginate, $orderby, $sort = 'DESC')
    {
        return self::with('OrganizationRetailinfo')->with('account')->where($where)->orderBy($orderby, $sort)->paginate($paginate);
    }


    /**
     * 添加数据
     * @param $param
     * @param $type
     * @param $where
     * @return bool
     */
    public static function insertData($param, $type = "update_create", $where = [])
    {
        switch ($type) {
            case "update_create":
                $res = self::updateOrCreate($where, $param);
                break;
            case "first_create":
                $res = self::firstOrCreate($param);
                break;
        }

        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }


    public function getSimpleOrder()
    {
        return $this->hasMany('App\Models\SimpleOrder', 'simple_id', "id");
    }


    public function getRetailOrder()
    {
        return $this->hasMany('App\Models\RetailOrder', 'retail_id', "id");
    }

    /**
     * 获取营收情况数据
     * @param $organization_id
     * @return array|bool|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getRevenueInfo($organization_id)
    {
        // 找到该组织id 下面的 店铺
        $res = self::select(["asset_id", "parent_tree"])->where(["id" => $organization_id])->first();
        if (!empty($res)) {
            $res = $res->toArray();
            // 通过结构树找到所有的店铺信息
            $parent_tree = "{$res["parent_tree"]}{$organization_id}";
            // 如果为10 就是零售的 订单信息，12 就是 简版餐饮 的订单信息
            if ($res["asset_id"] == 10) {
                $model = self::with(["getRetailOrder" => function ($query) {
                    $query->select(["order_price", "retail_id", "id", "created_at"])->where(["status" => 1]);
                }]);
            } else {
                $model = self::with(["getSimpleOrder" => function ($query) {
                    $query->select(["order_price", "simple_id", "id", "created_at"])->where(["status" => 1]);
                }]);
            }
            // 获取数据
            $res_shop = $model->select(["id", "organization_name"])->where("parent_tree", "like", "%$parent_tree%")->where(["type" => 4])->get();

            // 今天开始的时间戳
            $today_start = strtotime(date("Y-m-d") . " 00:00:00");
            // 今天结束的时间戳
            $today_end = strtotime("+1 day", $today_start);

            if (!empty($res_shop)) {
                $res_shop = $res_shop->toArray();
                foreach ($res_shop as $key => $val) {
                    // 今天的营收金额情况
                    $today_revenue_order_money = 0;
                    // 今天的营收订单情况
                    $today_revenue_order_num = 0;
                    // 今天的营收金额情况
                    $before_revenue_order_money = 0;
                    // 历史的营收订单情况
                    $before_revenue_order_num = 0;
                    if ($res["asset_id"] == 10) {
                        $order_info = $val["get_retail_order"];
                    }elseif (($res["asset_id"] == 12)){
                        $order_info = $val["get_simple_order"];

                    }
                    foreach ($order_info as $k => $v) {
                        if ($v["created_at"] > $today_start && $v["created_at"] <= $today_end) {
                            // 累加金额
                            $today_revenue_order_money += $v["order_price"];
                            // 累加订单
                            $today_revenue_order_num += 1;
                        } else {
                            $before_revenue_order_money += $v["order_price"];
                            $before_revenue_order_num += 1;
                        }
                    }
                    // 处理数据
                    $res_shop[$key]["today_order_money"] = $today_revenue_order_money;
                    $res_shop[$key]["today_order_num"] = $today_revenue_order_num;
                    $res_shop[$key]["before_order_money"] = $before_revenue_order_money;
                    $res_shop[$key]["before_order_num"] = $before_revenue_order_num;
                    $res_shop[$key]["all_order_money"] = $today_revenue_order_money + $before_revenue_order_money;
                }
            }
            // 返回数据
            return $res_shop;
        }
        return false;
    }


    public static function getShopSimpleInfo($organization_id)
    {
        $res = self::select(["asset_id", "parent_tree"])->where(["id" => $organization_id])->first();


        if (!empty($res)) {
            $res = $res->toArray();
            // 通过结构树找到所有的店铺信息
            $parent_tree = "{$res["parent_tree"]}{$organization_id}";
            // 获取数据
            $res_shop = self::select(["id", "organization_name"])->where("parent_tree", "like", "%$parent_tree%")->where(["type" => 4])->get();

            if (!empty($res_shop)) {
                $res_shop = $res_shop->toArray();
                $res_shop["shop_num"] = count($res_shop);
                $res_shop["order_money"] = 0;
                $res_shop["fans_num"] = 0;

                foreach ($res_shop as $val) {
                    $res_shop["fans_num"] += FansmanageUser::where(["id" => $val["id"]])->count("id");
                    if ($res["asset_id"] == 10) {
                        $res_shop["order_money"] += RetailOrder::where(["status" => 1, "retail_id" => $val["id"]])->sum("order_price");
                    } else {
                        $res_shop["order_money"] += SimpleOrder::where(["status" => 1, "simple_id" => $val["id"]])->sum("order_price");
                    }
                }
                return $res_shop;
            }
        }
        return false;
    }
}


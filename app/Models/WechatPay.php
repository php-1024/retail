<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WechatPay extends Model
{
    use SoftDeletes;
    protected $table = 'wechat_pay';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    public $guarded = [];

    /**
     * 获取数据
     * @param array $where
     * @param array $field
     * @return bool
     */
    public function getInfo($where = [], $field = [])
    {
        $res = self::select($field)->where($where)->first();
        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
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
            case "first_where_create":
                $res = self::where($where)->first();
                if (empty($res)) {
                    $res = self::create($param);
                }
                break;
        }

        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }
}

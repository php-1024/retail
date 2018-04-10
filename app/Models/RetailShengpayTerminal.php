<?php
/**
 * retail_shengpay_terminal表的模型
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetailShengpayTerminal extends Model
{
    use SoftDeletes;
    protected $table = 'retail_shengpay_terminal';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //获取单条信息
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    //添加数据
    public static function addShengpayTerminal($param)
    {
        $model = new RetailShengpayTerminal();
        $model->retail_id = $param['retail_id'];
        $model->terminal_num = $param['terminal_num'];
        $model->save();
        return $model->id;
    }

    //修改数据
    public static function editShengpayTerminal($where, $param)
    {
        if ($model = self::where($where)->first()) {
            foreach ($param as $key => $val) {
                $model->$key = $val;
            }
            $model->save();
        }
    }

    //获取单行数据的其中一列
    public static function getPluck($where, $pluck)
    {
        return self::where($where)->pluck($pluck);
    }

    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where)
    {
        $row = self::getPluck($where, 'id')->toArray();
        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    //获取分页列表
    public static function getPaginage($where, $paginate, $orderby, $sort = 'DESC')
    {
        return self::where($where)->orderBy($orderby, $sort)->paginate($paginate);

    }
}

?>
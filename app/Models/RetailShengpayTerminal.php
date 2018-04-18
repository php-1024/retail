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


    //和组织表一对一的关系
    public function organization(){
        return $this->belongsTo('App\Models\Organization', 'retail_id', 'id');
    }

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
        return self::where($where)->value($pluck);
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

    //获取分页列表
    public static function getPaginage($where, $paginate, $orderby, $sort = 'DESC')
    {
        return self::with('organization')->where($where)->orderBy($orderby, $sort)->paginate($paginate);

    }


    //获取分页列表
    public static function getPaginageTerminal($where, $organization_name=[], $paginate, $orderby, $sort = 'DESC')
    {
        return self::where($where)->join('organization as o', function ($join) use ($organization_name) {
            $join->on('retail_shengpay_terminal.retail_id', '=', 'o.id');
            if ($organization_name) {
                $join->where('organization_name', 'LIKE', "%{$organization_name}%");
            }
        })->select('retail_shengpay_terminal.id','retail_shengpay_terminal.retail_id','retail_shengpay_terminal.created_at','retail_shengpay_terminal.terminal_num','retail_shengpay_terminal.status','o.organization_name')->orderBy($orderby, $sort)->paginate($paginate);

    }







}

?>
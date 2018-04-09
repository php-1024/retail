<?php
/**
 * program_admin表的模型
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use SoftDeletes;
    protected $table = 'label';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    protected $guarded = ["fansmanage_id","store_id","label_name","label_number","wechat_id"];

    //获取单条信息
    public static function getOneLabel($where)
    {
        return self::where($where)->first();
    }

    // 获取列表
    public static function ListLabel($where)
    {
        return self::where($where)->get();
    }

    /**
     * 添加标签
     * @param $param
     * @return bool
     */
    public static function addLabel($param)
    {
        $res = self::create($param);
        if(!empty($res)){
            return $res->toArray();
        }else{
            return false;
        }
    }

    //修改数据
    public static function editLabel($where, $param)
    {
        $model = self::where($where)->first();
        foreach ($param as $key => $val) {
            $model->$key = $val;
        }
        $model->save();
    }

    // 查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where)
    {
        $row = self::getPluck($where, 'id')->toArray();
        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 获取某个标签的信息
     * @param array $where
     * @param array $field
     * @return bool
     */
    public static function getInfo($where = [], $field = [])
    {
        $res = self::select($field)->where($where)->first();
        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }

    /**
     * 获取单行数据的其中一列
     * @param $where
     * @param $pluck
     * @return mixed
     */
    public static function getPluck($where, $pluck)
    {
        return self::where($where)->pluck($pluck);
    }

    //获取分页数据
    public static function getPaginage($where, $paginate, $orderby, $sort = 'DESC')
    {
        return self::where($where)->orderBy($orderby, $sort)->paginate($paginate);
    }
}
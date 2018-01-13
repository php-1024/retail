<?php
/**
 * Created by PhpStorm.
 * User: Iszmxw
 * Date: 2018/1/10
 * Time: 11:40
 * zerone_config表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Setup extends Model{
    use SoftDeletes;
    protected $table = 'config';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //简易型查询单条数据
    public static function getOne($where)
    {
        return self::where($where)->first();

    }
    //简易型查询所有数据
    public static function get_all()
    {
        return self::all();

    }
    //修改数据
    public static function editSetup($where,$param)
    {
        if ($model = self::where($where)->first()) {
            foreach ($param as $key => $val) {
                $model->$key = $val;
            }
            $model->save();
        }
    }

    //软删除数据
    public static function deleteSetup($where){
        self::where($where)->delete();//软删除指定数据
    }

    //恢复指定软删除数据
    public static function restoreSetup($where){
        self::where('id','=',$where)->restore();//恢复指定软删除数据
    }
}
?>
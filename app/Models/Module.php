<?php
/**
 * module表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Module extends Model{
    protected $table = 'module';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取总数
    public static function getCount($where=[]){
        return self::where($where)->where('is_delete','0')->count();
    }

    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where){
        $row = self::getPluck($where,'id')->toArray();
        if(empty($row)){
            return false;
        }else{
            return true;
        }
    }
    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->where('is_delete','0')->pluck($pluck);
    }
}
?>
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
}
?>
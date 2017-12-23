<?php
/**
 * node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Node extends Model{
    protected $table = 'node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public static function getCount(){
        return self::where('is_delete','0')->count();
    }

}
?>
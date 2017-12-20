<?php
/**
 * admin表的模型
 *
 */
namespace App\Models\Study;
use Illuminate\Database\Eloquent\Model;
class Test extends Model{
    protected $connection = 'study';//设置数据库连接，默认连接到database.php mysql设置的数据库.
    protected $table = 'test';//数据表名
    protected $primaryKey = 'id';//主键
    public $timestamps = true;//是否使用时间戳created_at和updated_at

    public static function get_all(){
       return self::all();
    }

}
?>
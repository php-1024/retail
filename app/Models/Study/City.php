<?php
namespace App\Models\Study;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $connection = 'study';//设置数据库连接，默认连接到database.php mysql设置的数据库.
    protected $table = 'city';//数据表名
    protected $primaryKey = 'id';//主键
    public $timestamps = true;//是否使用时间戳created_at和updated_at
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function areas(){
        return $this->hasMany('App\Models\Study\Area', 'city_id');
    }

    public function getAreas(){
        return $this->find(1)->areas;
    }
}
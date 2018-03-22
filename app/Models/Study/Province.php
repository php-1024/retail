<?php
namespace App\Models\Study;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $connection = 'study';//设置数据库连接，默认连接到database.php mysql设置的数据库.
    protected $table = 'province';//数据表名
    protected $primaryKey = 'id';//主键
    public $timestamps = true;//是否使用时间戳created_at和updated_at
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function citys(){
        return $this->hasMany('App\Models\Study\City', 'province_id');
    }

    public function areas(){
        return $this->hasManyThrough('App\Models\Study\Area','App\Models\Study\City', 'province_id','city_id','id');
    }

    public function getCitys(){
        return $this->find(19)->citys;
    }

    public function getAreas(){
        return $this->find(19)->areas;
    }
}
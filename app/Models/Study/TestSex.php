<?php
namespace App\Models\Study;
use Illuminate\Database\Eloquent\Model;
class TestSex extends Model
{
    protected $connection = 'study';//设置数据库连接，默认连接到database.php mysql设置的数据库.
    protected $table = 'test_sex';//数据表名
    protected $primaryKey = 'id';//主键
    public $timestamps = true;//是否使用时间戳created_at和updated_at
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和text表一对一的关系
    public function test(){
        return $this->belongsTo('App\Models\Study\Test', 'test_id');
    }

    public function getUser(){
        return $this->find(2)->test;
    }
}
<?php
namespace App\Models\Study;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'study';//设置数据库连接，默认连接到database.php mysql设置的数据库.
    protected $table = 'role';//数据表名
    protected $primaryKey = 'id';//主键
    public $timestamps = true;//是否使用时间戳created_at和updated_at
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function users()
    {
        return $this->belongsToMany('App\Models\Study\User','user_role','user_id','role_id');
    }

    public function getUsers(){
        return $this->find(1)->users;
    }
}
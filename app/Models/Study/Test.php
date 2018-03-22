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
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    // protected $fillable = ['name','age'];//白名单列属性，可以赋值
    // protected $guarded = [];//黑名单列属性，不可以被赋值 比如管理员表不能设置是否超级管理员之歌属性

    //和sex表一对一的关系
    public function sex(){
        return $this->hasOne('App\Models\Study\TestSex', 'test_id');
    }
    //和comment表一对多的关系
    public function comment(){
        return $this->hasMany('App\Models\Study\TestComment', 'test_id');
    }

    public function getSex(){
        return $this->find(1)->sex;
    }


    public function getComment(){
        return $this->find(1)->comment;
    }


    public static function get_all(){
       return self::all();
    }

    public static function get_list(){
        return self::where('id','=','3')->get();
    }

    public static function get_paginate(){
        return self::paginate(5);
    }

    public static function get_find(){
        return self::find(1);
    }

    public static function get_first(){
        return self::where('id',2)->first();
    }

    //插入或更新单条数据
    public static function ins_save($data,$id=0){
        $db = new Test();
        if(!empty($id)){
            $db = Self::find($id);
        }
        foreach($data as $key=>$val) {
            $db->$key = $val;
        }
        $res = $db->save();
        return $res;
    }

    //更新多跳数据
    public static function do_update($whereparam , $data){
       return self::where($whereparam)->update($data);
    }

    //查询出模型，再删除模型 一定要查询到才能删除
    public static function select_delete($id){
        $model = Self::find($id);
        return $model->delete();
    }

    //知道主键ID ，直接删除模型
    public static function do_delete($id){
        return Self::destroy($id);
    }
}
?>
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
    // protected $guarded = [];//黑名单列属性，不可以被赋值
    public static function get_all(){
       return self::all();
    }

    public static function get_list(){
        return self::where('id','>','3')->get();
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
            $db = Test::find($id);
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
}
?>
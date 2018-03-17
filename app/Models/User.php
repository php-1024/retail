<?php
/**
 * node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model{
    use SoftDeletes;
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和账号多对多的关系
    public function storeUser()
    {
        return $this->hasOne('App\Models\StoreUser','user_id','id');
    }
    //和账号多对多的关系
    public function UserInfo()
    {
        return $this->hasOne('App\Models\UserInfo','user_id','id');
    }
    //和店铺粉丝操作记录一对多
    public function StoreUserLog()
    {
        return $this->hasMany('App\Models\StoreUserLog','user_id','id');
    }

    //和餐饮店铺订单CateringOrder一对多
    public function CateringOrder()
    {
        return $this->hasMany('App\Models\CateringOrder','user_id','id');
    }

    //和零售店铺订单RetailOrder一对多
    public function RetailOrder()
    {
        return $this->hasMany('App\Models\RetailOrder','user_id','id');
    }


    //简易型查询单条数据关联查询
    public static function getOneUser($where)
    {
        return self::where($where)->with('UserInfo')->first();
    }


    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::where($where)->orderBy($orderby,$sort);
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->get();
    }

    //修改数据
    public static function editUser($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
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
        return self::where($where)->pluck($pluck);
    }
    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

}
?>
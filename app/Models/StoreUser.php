<?php
/**
 * node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StoreUser extends Model{
    use SoftDeletes;
    protected $table = 'store_user';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //用户零壹账号源头表一对一的关系
    public function userOrigin(){
        return $this->hasOne('App\Models\UserOrigin', 'user_id','user_id');
    }

    //零壹粉丝端账号表一对一的关系
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }


    //用户消费推荐表（导流）一对一的关系
    public function userRecommender()
    {
        return $this->hasOne('App\Models\UserRecommender','user_id','user_id');
    }

    //简易型查询单条数据关联查询
    public static function getOneStoreUser($where)
    {
        return self::where($where)->first();
    }


    //查询获取列表
    public static function getListStoreUser($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::where($where)->with('UserLabel')->with('userOrigin')->with('user')->with('userRecommender')->orderBy($orderby,$sort);
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->get();
    }

    //修改数据
    public static function editStoreUser($where,$param){
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
        return self::where($where)->with('userOrigin')->with('user')->with('userRecommender')->orderBy($orderby,$sort)->paginate($paginate);
    }

}
?>
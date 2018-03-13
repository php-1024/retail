<?php
/**
 * catering_room表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringRoom extends Model{
    use SoftDeletes;
    protected $table = 'catering_room';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条信息
    public static function getOne($where){
        return self::with('nodes')->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringRoom();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加组织栏目分类
    public static function addRoom($param){
        $model = new CateringRoom();
        $model->name = $param['name'];
        $model->store_id = $param['store_id'];
        $model->branch_id = $param['organization_id'];
        $model->save();
        return $model->id;
    }
    //修改数据
    public static function editRoom($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
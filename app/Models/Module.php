<?php
/**
 * module表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Module extends Model{
    protected $table = 'module';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    //添加数据
    public static function addModule($param){
        $model = new Module();
        if(!empty($param['module_name'])){
            $model->module_name = $param['module_name'];
        }
        $model->save();
        return $model->id;
    }
    //和功能节点关联，多对多
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Node','module_node','module_id','node_id');
    }

    //获取总数
    public static function getCount($where=[]){
        return self::where($where)->where('is_delete','0')->count();
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
        return self::where($where)->where('is_delete','0')->pluck($pluck);
    }

    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('nodes')->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ModuleNode extends Model{
    use SoftDeletes;
    protected $table = 'module_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条数据
    public static function getOne($where){
        return self::where($where)->first();
    }
    
    //添加数据
    public static function addModuleNode($param){
        $model = new ModuleNode();
        $model->module_id = $param['module_id'];
        $model->node_id = $param['node_id'];
        $model->save();
    }

    //删除节点时，同时删除关系
    public static function deleteNode($node_id){
        return self::where('node_id',$node_id)->delete();
    }

    //删除节点时，同时删除关系
    public static function removeNode($node_id){
        return self::where('node_id',$node_id)->forceDelete();
    }

    //修改数据
    public static function editModuleNode($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

}
?>
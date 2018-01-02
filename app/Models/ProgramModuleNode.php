<?php
/**
 * program_module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramModuleNode extends Model{
    protected $table = 'program_module_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条数据
    public static function getOne($where){
        return self::where($where)->where('is_delete','0')->first();
    }

    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new ProgramModuleNode();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->get();
    }

    public static function addProgramModuleNode($param){
        $model = new ProgramModuleNode();
        $model->program_id = $param['program_id'];
        $model->module_id = $param['module_id'];
        $model->node_id = $param['node_id'];
        $model->save();
    }

    //修改数据
    public static function editProgramModuleNode($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }
}
?>
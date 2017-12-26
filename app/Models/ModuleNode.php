<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ModuleNode extends Model{
    protected $table = 'module_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //添加数据
    public static function addModuleNode($param){
        $model = new ModuleNode();
        $model->module_id = $param['module_id'];
        $model->node_id = $param['node_id'];
        $model->save();
    }

    public function test(){
        dump($this->nodes);
    }
    //和节点是一对多的关系
    public function nodes(){
        return $this->belongsTo('App\Models\Node', 'node_id');
    }

    //和模型是一对多的关系
    public function modules(){
        return $this->belongsTo('App\Models\Module', 'module_id');
    }
}
?>
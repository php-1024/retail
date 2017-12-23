<?php
/**
 * node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Node extends Model{
    protected $table = 'node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public static function getCount(){
        return self::where('is_delete','0')->count();
    }

    public static function addNode($param){
        $node = new Node();//重新实例化模型，避免重复
        if(!empty($param['node_name'])) {
            $node->node_name = $param['node_name'];//节点名称
        }
        if(!empty($param['node_name'])) {
            $node->route_name = $param['$route_name'];//路由名称
        }
        $node->save();//添加账号
    }

}
?>
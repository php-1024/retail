<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AccountNode extends Model
{
    use SoftDeletes;
    protected $table = 'account_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条信息
    public static function getOne($where){
        return self::where($where)->first();
    }

    //修改账号节点关系表
    public static function editAccountNode($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //添加用户权限节点关系
    public static function addAccountNode($param){
        $model = new AccountNode();
        $model->account_id = $param['account_id'];
        $model->node_id = $param['node_id'];
        $model->save();
        return $model->id;
    }

    //删除节点的同时删除用户权限节点
    public static function deleteNode($node_id){
        return self::where('node_id',$node_id)->delete();
    }

    //删除节点的同时删除用户权限节点
    public static function removeNode($node_id){
        return self::where('node_id',$node_id)->forceDelete();
    }

    public static function addNewsNode($program_id,$nodes){
        $organization_list = Organization::where('program_id',$program_id)->get();
        foreach($organization_list as $key=>$val){
            $main_account = Account::where('organization_id',$val['id'])->where('parent_id',0)->first();
            dump($main_account);
        }
    }

}
?>
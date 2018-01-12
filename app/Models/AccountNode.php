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

    //和账号多对多的关系
    public function accounts()
    {
        return $this->belongsToMany('App\Models\Account','role_account','role_id','account_id');
    }

    //添加用户权限节点关系
    public static function addAccountNode($param){
        $model = new AccountNode();
        $model->account_id = $param['account_id'];
        $model->node_id = $param['node_id'];
        $model->save();
        return $model->id;
    }
}
?>
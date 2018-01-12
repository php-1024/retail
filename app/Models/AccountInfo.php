<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AccountInfo extends Model
{
    use SoftDeletes;
    protected $table = 'account_info';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //添加用户个人信息
    public static function addAccountInfo($param){
        $model = new AccountInfo();
        $model->account_id = $param['account_id'];//组织id
        $model->realname = $param['realname'];//用户名
        $model->realname = $param['idcard'];//身份证号
        $model->save();
        return $model->id;
    }
}
?>
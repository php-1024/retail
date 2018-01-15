<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class OrganizationProxyinfo extends Model{
    use SoftDeletes;
    protected $table = 'organization_proxyinfo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //添加数据
    public static function addOrganizationProxyinfo($param){
        $program = new OrganizationProxyinfo();//实例化程序模型
        $program->organization_id = $param['organization_id'];//组织id
        $program->proxy_owner = $param['proxy_owner'];//服务商负责人姓名
        $program->proxy_owner_idcard = $param['proxy_owner_idcard'];//服务商负责人身份证
        $program->proxy_owner_mobile = $param['proxy_owner_mobile'];//服务商负责人手机号
        $program->save();
        return $program->id;
    }
}
?>
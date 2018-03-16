<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model{
    use SoftDeletes;
    protected $table = 'organization';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和Account表多对一的关系
    public function account(){
        return $this->hasOne('App\Models\Account', 'organization_id');
    }

    //和OrganizationProxyinfo表一对一的关系
    public function organizationAgentinfo(){
        return $this->hasOne('App\Models\OrganizationAgentinfo', 'agent_id');
    }
    //和assetsOperation表一对多的关系
    public function assetsOperation(){
        return $this->hasMany('App\Models\AssetsOperation', 'organization_id','id');
    }
    //和assetsOperation表一对多的关系
    public function assetsOperation_draw(){
        return $this->hasMany('App\Models\AssetsOperation', 'draw_organization_id','id');
    }

    //和organizationBranchinfo表一对一的关系
    public function organizationbranchinfo(){
        return $this->hasOne('App\Models\OrganizationBranchinfo', 'organization_id');
    }

    //和wechat_authorization表一对一的关系
    public function wechatAuthorization(){
        return $this->hasOne('App\Models\WechatAuthorization', 'organization_id');
    }

    //和WarzoneAgent表一对一的关系
    public function warzoneAgent(){
        return $this->hasOne('App\Models\WarzoneAgent', 'organization_id');
    }
    //和WarzoneAgent表 warzone表 一对一的关系
    public function warzone(){
        return $this->belongsToMany('App\Models\Warzone','warzone_proxy','organization_id','zone_id')->select('zone_name');
    }

    //获取分页数据-商户
    public static function getWarzoneAgentAndWarzone($where,$paginate,$orderby,$sort='DESC'){
        return self::with('warzone')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取单条信息-服务商
    public static function getOneAgent($where){
        return self::with('warzoneAgent')->with('organizationAgentinfo')->where($where)->first();
    }
    //获取单条信息-总店
    public static function getOneCatering($where){
        return self::with('warzoneAgent')->with('organizationbranchinfo')->where($where)->first();
    }

    //获取-服务商列表
    public static function getListAgent($where){
        return self::with('organizationAgentinfo')->with('account')->where($where)->get();
    }


    //获取多条信息
    public static function getList($where){
        return self::where($where)->get();
    }


    //获取分页数据-店铺
    public static function getOrganizationAndAccount($organization_name,$where,$paginate,$orderby,$sort='DESC'){
        $model = self::with('account');
        if(!empty($organization_name)){
            $model =$model->where('organization_name','like','%'.$organization_name.'%');
        }
        return $model->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //添加数据
    public static function addOrganization($param){
        $organization = new Organization();//实例化程序模型

        $organization->organization_name = $param['organization_name'];//组织名称
        $organization->parent_id = $param['parent_id'];//多级组织的关系
        $organization->parent_tree = $param['parent_tree'];//上级程序
        $organization->program_id = $param['program_id'];//组织关系树
        $organization->type = $param['type'];//类型 2为服务商
        $organization->status = $param['status'];//状态 1-正常 0-冻结
        $organization->save();
        return $organization->id;
    }
    //修改数据
    public static function editOrganization($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
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
        return self::where($where)->pluck($pluck);
    }
    //获取分页数据-服务商
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('warzoneAgent')->with('organizationAgentinfo')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取分页数据-分店
    public static function getbranch($where,$paginate,$orderby,$sort='DESC'){
        return self::with('organizationBranchinfo')->with('account')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
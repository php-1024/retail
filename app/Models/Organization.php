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
    public function organizationProxyinfo(){
        return $this->hasOne('App\Models\OrganizationProxyinfo', 'organization_id');
    }
    //和assetsOperation表一对多的关系
    public function assetsOperation(){
        return $this->hasMany('App\Models\AssetsOperation', 'organization_id','id');
    }
    //和assetsOperation表一对多的关系
    public function assetsOperation_draw(){
        return $this->hasMany('App\Models\AssetsOperation', 'draw_organization_id','id');
    }

    //和OrganizationProxyinfo表一对一的关系
    public function organizationCompanyinfo(){
        return $this->hasOne('App\Models\OrganizationCompanyinfo', 'organization_id');
    }

    //和organizationBranchinfo表一对一的关系
    public function organizationbranchinfo(){
        return $this->hasOne('App\Models\OrganizationBranchinfo', 'organization_id');
    }

    //和WarzoneProxy表一对一的关系
    public function warzoneProxy(){
        return $this->hasOne('App\Models\WarzoneProxy', 'organization_id');
    }
    //和WarzoneProxy表 warzone表 一对一的关系
    public function warzone(){
        return $this->belongsToMany('App\Models\Warzone','warzone_proxy','organization_id','zone_id')->select('zone_name');
    }

    //获取分页数据-商户
    public static function getWarzoneProxyAndWarzone($where,$paginate,$orderby,$sort='DESC'){
        return self::with('warzone')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取单条信息-商户
    public static function getOneProxy($where){
        return self::with('warzoneProxy','organizationproxyinfo')->where($where)->first();
    }
    //获取单条信息-总店
    public static function getOneCatering($where){
        return self::with('warzoneProxy','organizationbranchinfo')->where($where)->first();
    }

    //获取-服务商列表
    public static function getListProxy($where){
        return self::with('organizationCompanyinfo')->where($where)->get();
    }

    //获取单条信息-商户
    public static function getOneCompany($where){
        return self::with('organizationCompanyinfo')->where($where)->first();
    }
    //获取-商户列表
    public static function getArrayCompany($where){
        return self::with('organizationCompanyinfo')->with('account')->where($where)->get();
    }

    //获取分页数据-商户
    public static function getCompanyAndAccount($organization_name,$where,$paginate,$orderby,$sort='DESC'){
        $model = self::with('account');
        if(!empty($organization_name)){
            $model =$model->where('organization_name','like','%'.$organization_name.'%');
        }
        return $model->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //获取分页数据-店铺
    public static function getCateringAndAccount($organization_name,$where,$paginate,$orderby,$sort='DESC'){
        $model = self::with('account');
        if(!empty($organization_name)){
            $model =$model->where('organization_name','like','%'.$organization_name.'%');
        }
        return $model->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //获取分页数据-店铺分店
    public static function getBranchAndAccount($organization_name,$where,$paginate,$orderby,$sort='DESC'){
        $model = self::with('account');
        if(!empty($organization_name)){
            $model =$model->where('organization_name','like','%'.$organization_name.'%');
        }
        return $model->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //获取单条信息和organizationproxyinfo的信息
    public static function getOneAndorganizationproxyinfo($where){
        return self::with('organizationproxyinfo')->where($where)->first();
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
        return self::with('warzoneProxy','organizationproxyinfo')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取分页数据-商户
    public static function getCompany($where,$paginate,$orderby,$sort='DESC'){
        return self::with('organizationCompanyinfo')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取分页数据-分店
    public static function getbranch($where,$paginate,$orderby,$sort='DESC'){
        return self::with('organizationBranchinfo')->with('account')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
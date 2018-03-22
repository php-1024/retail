<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WechatDefinedMenu extends Model{
    use SoftDeletes;
    protected $table = 'wechat_defined_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和organization表一对一的关系
    public function organization(){
        return $this->belongsto('App\Models\Organization', 'organization_id');//by tang,hasone-->belongsto
    }

    //和wechat_authorizer_info表一对一的关系
    public function wechatAuthorizerInfo(){
        return $this->hasOne('App\Models\WechatAuthorizerInfo', 'authorization_id');
    }

    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new WechatDefinedMenu();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    public static function addDefinedMenu($param){
        $model = new WechatDefinedMenu();
        $model->organization_id = $param['organization_id'];
        $model->authorizer_appid = $param['authorizer_appid'];
        $model->menu_name = $param['menu_name'];
        $model->parent_id = $param['parent_id'];
        $model->parent_tree = $param['parent_tree'];
        $model->event_type = $param['event_type'];
        $model->response_type = $param['response_type'];
        $model->response_url = $param['response_url'];
        $model->response_keyword = $param['response_keyword'];
        $model->save();
        return $model->id;
    }

    //删除菜单
    public static function removeDefinedMenu($id){
        return self::where('id',$id)->forceDelete();
    }

    public static function editDefinedMenu($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }
}
?>
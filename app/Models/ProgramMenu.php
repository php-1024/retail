<?php
/**
 * program表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramMenu extends Model{
    use SoftDeletes;
    protected $table = 'program_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和comment表一对多的关系
    public function program(){
        return $this->belongsTo('App\Models\Program', 'program_id');
    }

    //获取子菜单列表
    public static function son_menu($id){
        return self::getList([['parent_id',$id]],0,'sort','asc');
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new ProgramMenu();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加菜单
    public static function addMenu($param){
        $model = new ProgramMenu();//实例化程序模型
        $model->program_id = $param['program_id'];//所属程序ID
        $model->parent_id = $param['parent_id'];//上级菜单ID
        $model->parent_tree = $param['parent_tree'];//上级菜单树
        $model->menu_name = $param['menu_name'];//菜单名称
        $model->is_root = $param['is_root'];//是否根菜单
        $model->icon_class = $param['icon_class'];//ICON样式名称
        $model->menu_route = $param['menu_route'];//跳转路由
        $model->menu_routes_bind = $param['menu_routes_bind'];//关联路由字符串，使用逗号分隔
        $model->save();
        return $model->id;
    }
    //编辑戴丹
    public static function editMenu($where,$param){
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
    //软删除菜单
    public static function deleteMenu($where){
        $target = self::where($where)->first();//要删除的目标菜单
        self::where('parent_tree','like',$target['parent_tree'].','.$target['id']."%")->delete();//删除所有子菜单
        self::where($where)->delete();//删除所有子菜单
    }
    //彻底删除菜单
    public static function removeMenu($where){
        $target = self::where($where)->first();//要删除的目标菜单
        self::where('parent_tree','like',$target['parent_tree'].','.$target['id']."%")->forceDelete();//删除所有子菜单
        self::where($where)->forceDelete();//删除所有子菜单
    }

    //删除节点的同时删除菜单,并更新该程序下所有用户的菜单缓存
    public static function deleteNode($route_name)
    {
        $list = self::where([['menu_route', $route_name]])->get();//获取所有使用该节点的菜单
        //self::where([['menu_route',$route_name]])->delete();//删除对应的菜单
        if (!empty($list)) {
            foreach ($list as $key => $val) {
                $organization_list = Organization::where('program_id',$val->program_id)->get();//通过程序ID，获取所有使用该程序的组织
                if(!empty($organization_list)) {
                    foreach ($organization_list as $k => $v) {
                        $account_list = Account::where('organization_id',$v->id)->get();//查询这些程序下的所有账号
                        if(!empty($account_list)){
                           foreach($account_list as $kk=>$vv){

                              \ZeroneRedis::create_menu_cache($vv->id,$val->program_id);//重新生成对应账号的系统菜单缓存
                           }
                        }
                        \ZeroneRedis::create_menu_cache(1,$val->program_id);//重新生成超级管理员的系统菜单缓存
                        unset($account_list);
                    }
                }
                unset($organization_list);
            }
        }

    }
}
?>
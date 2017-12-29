<?php
/**
 * program表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramMenu extends Model{
    protected $table = 'program_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和comment表一对多的关系
    public function program(){
        return $this->belongsTo('App\Models\Program', 'program_id');
    }

    public function getSonMenu(){
        return $this->getSonMenu($this->id);
    }

    public function son_menu($id){
        return self::getList([['parent_id'=>$id]],0,'id','asc');
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new ProgramMenu();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->get();
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
        return self::where($where)->where('is_delete','0')->pluck($pluck);
    }
}
?>
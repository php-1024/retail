<?php
/**
 * module表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Module extends Model{
    use SoftDeletes;
    protected $table = 'module';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和功能节点关联，多对多
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Node','module_node','module_id','node_id');
    }

    //在程序中和功能节点的关联，多对多
    public function program_nodes()
    {
        return $this->belongsToMany('App\Models\Node','program_module_node','module_id','node_id');
    }

    //和程序关联，多对多
    public function programs()
    {
        return $this->belongsToMany('App\Models\Program','program_module_node','module_id','program_id');
    }

    //获取新建独立主程序时的模块列表
    public static function getListSimple($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with('nodes')->where($where)->orderBy($orderby,$sort);
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->get();
    }

    //获取新建独立主程序时的模块列表
    public static function getListProgram($program_id,$where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with(['program_nodes'=>function($query) use ($program_id){
            $query->where('program_id',$program_id);
        }])->whereIn('id',function($query) use ($program_id){
            $query->from('program_module_node')->select('module_id')->where('program_id',$program_id);
        })->where($where)->orderBy($orderby,$sort);

        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->get();
    }

    //添加数据
    public static function addModule($param){
        $model = new Module();
        $model->module_name = $param['module_name'];
        $model->module_show_name = $param['module_show_name'];
        $model->save();
        return $model->id;
    }
    //修改数据
    public static function editModule($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //获取总数
    public static function getCount($where=[]){
        return self::where($where)->count();
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

    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('nodes')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //去重后获取程序的模型
    public static function getProgramModules($program_id){
        return self::whereIn('id',function($query) use ($program_id){
            $query->from('program_module_node')->select('module_id')->where('program_id',$program_id)->groupBy('module_id')->get();
        })->get();
    }

}
?>
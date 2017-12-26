<?php
/**
 * program表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Program extends Model{
    protected $table = 'program';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和程序关联，多对多
    public function modules()
    {
        return $this->belongsToMany('App\Models\Module','program_module_node','program_id','module_id');
    }

    //和程序关联，多对多
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Node','program_module_node','program_id','node_id');
    }

    //和程序关联，多对多
    public function program_parents()
    {
        return $this->belongsToMany('App\Models\Program','program as program_parent','id','node_id');
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new Program();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->get();
    }

    //添加数据
    public static function addProgram($param){
        $program = new Program();//实例化程序模型
        $program->program_name = $param['program_name'];//程序名称
        $program->complete_id = $param['complete_id'];//上级程序
        $program->is_classic = $param['is_classic'];//是否通用版本
        $program->is_asset = $param['is_asset'];//是否资产程序
        $program->is_coupled = $param['is_coupled'];//是否夫妻程序
        $program->save();
        return $program->id;
    }

    //获取总数
    public static function getCount($where=[]){
        return self::where($where)->where('is_delete','0')->count();
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

    //获取程序分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('modules')->with('program_parents')->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->paginate($paginate);
    }

    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->where('is_delete','0')->pluck($pluck);
    }
}
?>
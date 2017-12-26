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
    public function Modules()
    {
        return $this->belongsToMany('App\Models\Module','program_module_node','program_id','module_id');
    }

    //和程序关联，多对多
    public function Nodes()
    {
        return $this->belongsToMany('App\Models\Node','program_module_node','program_id','node_id');
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new Program();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->get();
    }

    //获取总数
    public static function getCount($where=[]){
        return self::where($where)->where('is_delete','0')->count();
    }

}
?>
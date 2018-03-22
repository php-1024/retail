<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrganizationAssets extends Model{
    use SoftDeletes;
    protected $table = 'organization_assets';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条信息
    public static function getOne($where){
        return self::where($where)->first();
    }
    //添加数据
    public static function addAssets($param){
        $program = new OrganizationAssets();//实例化程序模型
        $program->organization_id = $param['organization_id'];//组织id
        $program->program_id = $param['program_id'];//程序名称
        $program->program_balance = $param['program_balance'];//剩余数量
        $program->program_used_num = $param['program_used_num'];//使用数量
        $program->save();
        return $program->id;
    }
    //修改数据
    public static function editAssets($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }
    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }

}
?>
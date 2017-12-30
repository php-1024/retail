<?php
/**
 * module表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PackageProgram extends Model{
    protected $table = 'package_program';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条数据
    public static function getOne($where){
        return self::where($where)->where('is_delete','0')->first();
    }

    //添加配套
    public static function addPackageProgram($params){
        $model = new PackageProgram();
        $model->package_id = $params['package_id'];
        $model->program_id = $params['program_id'];
        $model->save();
        return $model->id;
    }
}
?>
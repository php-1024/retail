<?php
/**
 * module表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Package extends Model{
    protected $table = 'package';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和程序时多对多的关系
    public function programs()
    {
        return $this->belongsToMany('App\Models\Program','package_program','package_id','program_id');
    }

    //添加配套
    public static function addPackage($params){
        $model = new Package();
        $model->package_name = $params['package_name'];
        $model->package_price = $params['package_price'];
        $model->save();
        return $model->id;
    }
    //修改数据
    public static function editPackage($where,$param){
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
        return self::where($where)->where('is_delete','0')->pluck($pluck);
    }

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('programs')->where($where)->where('is_delete','0')->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
<?php
/**
 * retail_config表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailConfig extends Model{
    use SoftDeletes;
    protected $table = 'retail_config';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::where($where);
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->orderBy($orderby,$sort)->get();
    }


    //修改数据
    public static function editAccount($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //添加用户
    public static function addAccount($param){
        $model = new Account();
        $model->organization_id = $param['organization_id'];//组织ID
        $model->parent_id = $param['parent_id'];//上级用户ID
        $model->parent_tree = $param['parent_tree'];//组织树
        $model->deepth = $param['deepth'];//用户在该组织里的深度
        $model->account = $param['account'];//登录账号（零壹平台,自动生成）
        $model->password = $param['password'];//登录密码（MD5默认32位长度）
        $model->mobile = $param['mobile'];//管理员绑定的手机号码
        if($param['uuid']){
            $model->uuid = $param['uuid'];
        }
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
        return self::where($where)->pluck($pluck);
    }

}
?>
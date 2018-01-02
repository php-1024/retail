<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ToolingAccount extends Model{
    use SoftDeletes;
    protected $table = 'tooling_account';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function login_logs(){
        return $this->hasMany('App\Models\ToolingLoginLog', 'account_id');
    }

    public function operation_logs(){
        return $this->hasMany('App\Models\ToolingOperationLog', 'account_id');
    }
    //简易型查询单条数据
    public static function getOne($where)
    {
        return self::where($where)->first();
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
    //添加数据
    public static function addAccount($param){
        $model = new ToolingAccount();
        if(!empty($param['account'])){
            $model->account = $param['account'];
        }
        if(!empty($param['password'])){
            $model->password = $param['password'];
        }
        $model->save();
    }

    //修改数据
    public static function editAccount($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }
}
?>
<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Label extends Model{
    use SoftDeletes;
    protected $table = 'label';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //获取单条信息
    public static function getOneMemberLabel($where){
        return self::where($where)->first();
    }
    //获取列表
    public static function ListMemberLabel($where){
        return self::where($where)->get();
    }
    //添加会员标签
    public static function addMemberLabel($param){
        $model = new Label();
        $model->organization_id = $param['organization_id'];//组织ID
        $model->member_name = $param['label_name'];//组织ID
        $model->parent_id = $param['parent_id'];//上级id
        $model->member_number = $param['label_number'];//粉丝数量
        $model->save();
        return $model->id;
    }

    //修改数据
    public static function editMemberLabel($where,$param){
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
    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
<?php
/**
 * module表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Package extends Model{
    use SoftDeletes;
    protected $table = 'package';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    //和程序时多对多的关系
    public function programs()
    {
        return $this->belongsToMany('App\Models\Program','package_program','package_id','program_id');
    }
    //和AssetsOperation表一对多的关系
    public function assets_operation(){
        return $this->hasMany('App\Models\AssetsOperation','package_id','id');
    }
    //和assets表一对多的关系
    public function assets(){
        return $this->hasMany('App\Models\Assets','package_id','id');
    }

    //添加配套
    public static function addPackage($params){
        $model = new Package();
        $model->package_name = $params['package_name'];
        $model->package_price = $params['package_price'];
        $model->save();
        return $model->id;
    }
    //查询一条数据
    public static function getOnePackage($where){
        return self::with('programs')->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new Package();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->with('programs')->where($where)->orderBy($orderby,$sort)->get();
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
        return self::where($where)->pluck($pluck);
    }
    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('programs')->with(['assets'=>function($query){
            $query->where([['assets.package_id','package.id'],['assets.program_id','programs.id']]);
        }])->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>
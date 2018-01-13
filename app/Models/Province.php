<?php
/**
 * Province表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Province extends Model{
    use SoftDeletes;
    protected $table = 'province';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和Province表一对多的关系
    public function province(){
        return $this->hasMany('App\Models\WarzoneProvince', 'province_id');
    }
}
?>
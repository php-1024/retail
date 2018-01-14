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

    //和战区节点关联，多对多
    public function warzone()
    {
        return $this->belongsToMany('App\Models\Warzone','warzone_province','zone_id','province_id');
    }

}
?>
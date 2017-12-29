<?php
/**
 * program表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PrograMenu extends Model{
    protected $table = 'program_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和comment表一对多的关系
    public function program(){
        return $this->belongsTo('App\Models\Program', 'program_id');
    }
}
?>
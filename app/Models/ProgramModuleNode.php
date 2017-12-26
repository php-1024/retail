<?php
/**
 * program_module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramModuleNode extends Model{
    protected $table = 'program_module_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
}
?>
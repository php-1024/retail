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
    public $timestamps = false;
}
?>
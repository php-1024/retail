<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ModuleNode extends Model{
    protected $table = 'module_node';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
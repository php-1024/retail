<?php
/**
 * program_operation_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingOperationLog extends Model{
    protected $table = 'tooling_operation_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

}
?>
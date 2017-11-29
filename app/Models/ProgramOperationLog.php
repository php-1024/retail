<?php
/**
 * program_operation_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PragramOperationLog extends Model{
    protected $table = 'program_operation_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
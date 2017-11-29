<?php
/**
 * program_error_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramErrorLog extends Model{
    protected $table = 'program_error_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
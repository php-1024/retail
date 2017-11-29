<?php
/**
 * program_login_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramLoginLog extends Model{
    protected $table = 'program_login_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
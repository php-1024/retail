<?php
/**
 * 操作日志表
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LoginLog extends Model{
    protected $table = 'operation_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
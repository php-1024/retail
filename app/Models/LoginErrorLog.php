<?php
/**
 * 登录错误记录表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LoginErrorLog extends Model{
    protected $table = 'login_error_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
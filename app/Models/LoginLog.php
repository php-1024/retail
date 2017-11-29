<?php
/**
 * 登录日志表
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LoginLog extends Model{
    protected $table = 'login_log';
    protected $primaryKey = 'id';
    public $timestamps = true;

}
?>
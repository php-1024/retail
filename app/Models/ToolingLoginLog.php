<?php
/**
 * program_login_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingLoginLog extends Model{
    protected $table = 'tooling_login_log';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }
}
?>
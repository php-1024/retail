<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingAccount extends Model{
    protected $table = 'tooling_account';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }
    public function operation_log()
    {
        return $this->hasMany('App\Models\ProgramOperationLog','account_id');
    }
}
?>
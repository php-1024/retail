<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramAdmin extends Model{
    protected $table = 'program_admin';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }
    public function operation_log()
    {
        return $this->belongsToMany('App\Models\ProgramOperationLog');
    }
}
?>
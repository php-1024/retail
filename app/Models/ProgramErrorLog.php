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
    public $timestamps = true;

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }
}
?>
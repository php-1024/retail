<?php
/**
 * program_error_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingErrorLog extends Model{
    protected $table = 'tooling_error_log';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }
}
?>
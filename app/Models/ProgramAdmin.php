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
    public $timestamps = false;
}
?>
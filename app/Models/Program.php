<?php
/**
 * program表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Program extends Model{
    protected $table = 'program';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

}
?>
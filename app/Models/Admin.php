<?php
/**
 * admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Admin extends Model{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
?>
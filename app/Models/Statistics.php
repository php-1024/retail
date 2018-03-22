<?php
/**
 * Created by PhpStorm.
 * User: Iszmxw
 * Date: 2018/1/9
 * Time: 14:31
 * zerone_statistics表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Statistics extends Model
{
    use SoftDeletes;
    protected $table = 'statistics';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
}
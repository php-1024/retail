<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 15:57
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class XhoLog extends Model
{
    protected $table = 'xho_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    protected $guarded = [];

}
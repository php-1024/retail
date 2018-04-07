<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WechatDefinedMenu extends Model
{
    use SoftDeletes;
    protected $table = 'wechat_defined_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    // 设置允许注入到数据库的字段
    protected $guarded = [];


    //和organization表一对一的关系
    public function organization()
    {
        return $this->belongsto('App\Models\Organization', 'organization_id');//by tang,hasone-->belongsto
    }

    //和wechat_authorizer_info表一对一的关系
    public function wechatAuthorizerInfo()
    {
        return $this->hasOne('App\Models\WechatAuthorizerInfo', 'authorization_id');
    }

    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    //简易型查询单条数据关联查询
    public static function ListWechatDefinedMenu($where)
    {
        return self::where($where)->get();
    }

    /**
     * 获取菜单列表
     * @param $where
     * @param int $limit
     * @param $orderby
     * @param string $sort
     * @return mixed
     */
    public static function getList($where, $limit = 0, $orderby, $sort = 'DESC')
    {
        $model = new WechatDefinedMenu();
        if (!empty($limit)) {
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby, $sort)->get();
    }

    /**
     * 添加菜单数据
     * @param $param
     * @return mixed
     */
    public static function addDefinedMenu($param)
    {
        $res = self::create($param);
        return $res->toArray();
    }

    /**
     * 删除菜单
     * @param $where
     * @return mixed
     */
    public static function removeDefinedMenu($where)
    {
        return self::where($where)->forceDelete();
    }

    /**
     * 编辑菜单
     * @param $where
     * @param $param
     */
    public static function editDefinedMenu($where, $param)
    {
        $res = self::where($where)->first();
        if (!empty($res)) {
            self::where($where)->update($param);
        }
    }

    /**
     * 获取菜单数量
     * @param $where
     * @return mixed
     */
    public static function getCount($where)
    {
        return self::where($where)->count();
    }

    /**
     * 获取单行数据的其中一列
     * @param $where
     * @param $pluck
     * @return mixed
     */
    public static function getPluck($where, $pluck)
    {
        return self::where($where)->pluck($pluck);
    }
}
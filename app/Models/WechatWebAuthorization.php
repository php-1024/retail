<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WechatWebAuthorization extends Model
{
    use SoftDeletes;
    protected $table = 'wechat_web_authorization';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    public $guarded = [];

    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    public static function addAuthorization($param)
    {
        $model = new WechatWebAuthorization();
        $model->access_token = $param['access_token'];
        $model->refresh_token = $param['refresh_token'];
        $model->access_token_expires = $param['expire_time'];
        $model->expire_time_refresh = $param['expire_time_refresh'];
        $model->save();
        return $model->id;
    }

    public static function editAuthorization($where, $param)
    {
        if ($model = self::where($where)->first()) {
            foreach ($param as $key => $val) {
                $model->$key = $val;
            }
            $model->save();
        }
    }

    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where)
    {
        $row = self::getPluck($where, 'id')->toArray();
        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    //获取单行数据的其中一列
    public static function getPluck($where, $pluck)
    {
        return self::where($where)->pluck($pluck);
    }


    /**
     * 返回微信配置信息
     * @param string $wxid 微信唯一标识
     * @return mixed
     */
    public static function getWechatConfig($wxid)
    {
        return self::where("wxid", $wxid)->first()->toArray();
    }


    /**
     * 微信公众号验证信息更新
     *
     * @param array $wechat_config 微信配置信息
     * @param array $update_arr 更新对象的数组,数组值为["jssdk"],默认为access_token
     *
     * @return mixed
     */
    public static function updateWechatVoucher($wechat_config,
                                               $update_arr = []
    )
    {
        $wechat_config = self::updateAccessToken($wechat_config);
        // 判断是否需要更新jssdk
        if (in_array("jssdk", $update_arr)) {
            self::updateJSSDK($wechat_config);
        }
        // 判断是否需要更新
        if (!empty($update_arr)) {
            return self::where("wxid", $wechat_config['wxid'])->first()
                ->toArray();
        }
        return $wechat_config;
    }

    /**
     * 更新access_token 信息,并且返回最新的信息
     *
     * @param array $wechat_config 微信配置信息
     *
     * @return mixed
     */
    private static function updateAccessToken($wechat_config)
    {
        $expire_time = time() + 7000;
        // 判断是否有access_token 或者 access_token 是否已经过期
        // 如果过期就进行更新

        if (empty($wechat_config['access_token'])
            || time() >= $wechat_config['access_token_expires']
        ) {
            $res = \Wechat::get_access_token();
            $res_api_access = $res["access_token"];
        }


        // 没有过期的情况
        if (!empty($res_api_access["access_token"])) {
            // 更新信息
            self::where(['wxid' => $wechat_config['wxid']])
                ->update(
                    [
                        'access_token' => $res_api_access["access_token"],
                        'access_token_expires' => $expire_time,
                    ]
                );
            return self::where("wxid", $wechat_config['wxid'])->first()
                ->toArray();
        }
        return $wechat_config;
    }

    /**
     * 更新jssdk 的ticket 信息
     * @param array $wechat_config 微信配置信息
     */
    private static function updateJSSDK($wechat_config)
    {
        $expire_time = time() + 7000;
        // 判断是否有jsapi_ticket 或者 jsapi_ticket 是否已经过期
        // 如果过期就进行更新
        if (empty($wechat_config['jsapi_ticket'])
            || time() >= $wechat_config['jsapi_expires']
        ) {
            // 获取 jsapi_ticket
            $res_api_js = \Wechat::get_jssdk_ticket($wechat_config['access_token']);
        }
        // 没有过期的情况
        if (!empty($res_api_js["ticket"])) {
            // 更新信息
            self::where(['wxid' => $wechat_config['wxid']])
                ->update(
                    [
                        'jsapi_ticket' => $res_api_js["ticket"],
                        'jsapi_expires' => $expire_time,
                    ]
                );
        }
    }
}
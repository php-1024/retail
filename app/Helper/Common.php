<?php
//公共方法，生成账号数据Redis缓存
/*
 * key_id  - 目前以用户ID作为Redis的key的关键字
 * admin_data - 需要缓存的数据
 */
if (!function_exists('create_account_cache')) {
    function create_account_cache($key_id, $admin_data)
    {
        $admin_data = serialize($admin_data);//序列化数组数据
        Redis::connection('zeo');//连接到我的redis服务器
        $data_key = 'zerone_system_admin_data_' . $key_id;
        Redis::set($data_key, $admin_data);
    }
}
?>
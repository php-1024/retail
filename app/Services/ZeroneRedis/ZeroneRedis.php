<?php
namespace App\Services\ZeroneRedis;
use Illuminate\Support\Facades\Redis;
use App\Models\ProgramMenu;
class ZeroneRedis
{
    //内部方法，生成账号数据Redis缓存
    /*
     * key_id  - 目前以用户ID作为Redis的key的关键字
     * admin_data - 需要缓存的数据
     */
    public static function create_account_cache($key_id,$admin_data){
        $admin_data = serialize($admin_data);//序列化数组数据
        Redis::connection('zeo');//连接到我的redis服务器
        $data_key = 'zerone_system_admin_data_'.$key_id;
        Redis::set($data_key,$admin_data);
    }

    //内部方法，生成对应程序及账号的菜单
    /*
     * id - 用户的ID
     */
    public static function create_menu_cache($id){
        $menu = ProgramMenu::getList([[ 'parent_id',0],['program_id','1']],0,'id','asc');//获取零壹管理系统的一级菜单
        $son_menu = [];
        foreach($menu as $key=>$val){//获取一级菜单下的子菜单
            $son_menu[$val->id] = ProgramMenu::son_menu($val->id);
        }
        if($id <> 1){
            /**
             * 未完成，这里准备查询用户权限。
             */
        }
        $menu = serialize($menu);
        $son_menu = serialize($son_menu);
        Redis::connection('zeo');//连接到我的redis服务器
        $menu_key = 'zerone_system_menu_'.$id;  //一级菜单的Redis主键。
        $son_menu_key = 'zerone_system_son_menu_'.$id;//子菜单的Redis主键
        Redis::set($menu_key,$menu);
        Redis::set($son_menu_key,$son_menu);
    }
}
?>
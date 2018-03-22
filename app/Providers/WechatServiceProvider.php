<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('WechatService', function () {
            return new \App\Services\Wechat\WechatApi();
        });
    }
}
?>
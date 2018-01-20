<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ZeroneRedisServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('ZeroneRedisService', function () {
            return new \App\Services\ZeroneRedis\ZeroneRedis();
        });
    }
}
?>
<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HttpCurlServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('HttpCurlService', function () {
            return new \App\Services\Curl\HttpCurl();
        });
    }
}
?>
<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IP2AttrServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('IP2AttrService', function () {
            return new \App\Services\IP2Attr\IP2Attr();
        });
    }
}
?>
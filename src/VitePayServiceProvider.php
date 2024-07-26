<?php

namespace ViteGroup\VitePay;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use function ViteGroup\VitePay\config_path;

class VitePayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/vitepay.php' => config_path('vitepay.php'),
        ], 'vitepay');

        try {
            if (!file_exists(config_path('vitepay.php'))) {
                $this->commands([
                    \Illuminate\Foundation\Console\VendorPublishCommand::class,
                ]);

                Artisan::call('vendor:publish', ['--provider' => 'ViteGroup\\VitePay\\VitePayServiceProvider', '--tag' => ['vitepay']]);
            }
        } catch (\Exception) {}
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/vitepay.php', 'vitepay'
        );
        $this->app->singleton(\ViteGroup\VitePay\VitePaySdk::class, function ($app) {
            $api_key = $app['config']['vitepay.api_key'];
            return new \ViteGroup\VitePay\VitePaySdk($api_key);
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\Citrus;
use App\Library\Services\Instamojo;
use App\Library\Services\Payu;


class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PaymentGateway', function ($app) {
          return new Citrus();
          // return new Instamojo();
          // return new Payu();
        });
    }
}

<?php
namespace PP_Currency\Providers;

use Silex\Application,
    Silex\ServiceProviderInterface,
    PP_Currency\Controllers\CurrencyController;

class ControllerProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['currency.controller'] = $app->share(
            function () use ($app) {
                return new CurrencyController($app);
            }
        );
    }

    public function boot(Application $app){}
}
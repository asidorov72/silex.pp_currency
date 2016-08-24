<?php

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

/*
|-----------------------------------------------------------------------------------
| Get app bootstrap
|-----------------------------------------------------------------------------------
*/

require_once __DIR__.'/bootstrap.php';

Symfony\Component\Debug\ErrorHandler::register();

$app = new Silex\Application();

/*
|-----------------------------------------------------------------------------------
| Setup configuration
|-----------------------------------------------------------------------------------
*/

$app['config'] = require_once CONFIG_PATH.'/config.php';

//$app->register(new Silex\Provider\CsrfServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new PP_Currency\Providers\ControllerProvider());

$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path'  => __DIR__ . '/../src/PP_Currency/Views',
        'twig.options' => array(
            'cache' => __DIR__  . '/../cache',
        )
    )
);

$app->register(new Silex\Provider\FormServiceProvider());

require_once __DIR__.'/di.php';

$app['debug'] = true;

require_once __DIR__ . '/../app/routes.php';

return $app;
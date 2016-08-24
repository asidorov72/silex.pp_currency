<?php

//$app['user'] = $app->share(
//    function () use ($app) {
//        $auth = new \Colosseum\Model\AppFactory($app);
//        return $auth->createAuth();
//    }
//);
//
//$app['auth.vegas'] = $app->share(
//    function () use ($app) {
//        return new \Colosseum\Model\VegasAuth($app);
//    }
//);
//
//$app['auth.livecasino'] = $app->share(
//    function () use ($app) {
//        return new \Colosseum\Model\LivecasinoAuth($app);
//    }
//);
//

$app['currency.repository'] = $app->share(
    function () use ($app) {
        return new \PP_Currency\Repository\CurrencyRepository($app);
    }
);

$app['transporter'] = $app->share(
    function () use ($app) {
        return new \PP_Currency\Transporter\Curl($app);
    }
);
//
//$app['url'] = $app->share(
//    function () use ($app) {
//        return new \Colosseum\Helper\UrlHelper($app);
//    }
//);
//


//$app['twig.loader'] = $app->share(
//    function () use ($app) {
//        return new Twig_Loader_Filesystem(__DIR__ . '/../src/PP_Currency/Views');
//    }
//);
    
//$app['form.registry'] = $app->share(function() use ($app) {
//    $resolvedTypeFactory = new Symfony\Component\Form\ResolvedFormTypeFactory();
//    return new Symfony\Component\Form\FormRegistry($app['form.extensions'], $resolvedTypeFactory);
//});

// array('csrf_protection' => false)
    
//$app['form.factory'] = $app->share(
//    //function() use ($app) {
//        //$resolvedTypeFactory = new Symfony\Component\Form\ResolvedFormTypeFactory();
//        //var_dump($resolvedTypeFactory);
//        //die();
//        //return new Symfony\Component\Form\FormFactory($app['form.registry'], $resolvedTypeFactory);
//   // }
//);

//$app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
//    $types[] = new YourFormType();
//
//    return $types;
//}));

//$app['form.type.extensions'] = $app->share($app->extend('form.type.extensions', function($extensions) use ($app) {
//    $extensions[] = new AddressType();
//    return $extensions;
//}));

//$app['form.extensions'] = $app->share($app->extend('form.extensions',
//    function($extensions) use ($app) {
//        $extensions[] = new MyTypesExtension();
//        return $extensions;
//    })
//);
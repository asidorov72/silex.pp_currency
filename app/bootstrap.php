<?php
/**
 * File for bootstrapping the application and defining app constants
 *
 * @package    Colosseum
 * @subpackage Casinomobile-api
 * @author     Peter Caulfield <peter.caulfield@paddypower.com>
 */

//require_once __DIR__.'/../vendor/autoload.php';
$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->add('PP_Currency', __DIR__ . '/../src');

/*
|-----------------------------------------------------------------------------------
|   Define app constants
|-----------------------------------------------------------------------------------
*/

//define('LOG_PATH', __DIR__.'/../logs');
define('CONFIG_PATH', __DIR__.'/config');
//define('LOCALE_PATH', __DIR__.'/../resources/locales');

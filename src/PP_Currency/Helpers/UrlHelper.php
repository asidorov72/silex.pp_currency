<?php

namespace PP_Currency\Helpers;

use PP_Currency\Helpers\ToolsHelper;

class UrlHelper
{
    private $app;
    protected $request;
    protected $session;
    protected $config;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->request = $app['request'];
        $this->session = $app['session'];
        $this->config = $app['config'];
    }
    
    /*
     * The function is replacing URLs placeholders kind of "{CURRENCY_CODE}"
     * with real values.
     * 
     * @param $url string - request url with placeholders
     * @param $placeHolderCode string - a placeholder in braces like {CURRENCY_CODE} to be replaced with real value
     * @param $newValue string - real data to replace the placeholder
     * @returns string URL
     */
    public static function replaceParams($url, $placeHolderCode, $newValue) 
    {
        $newUrl = str_replace($placeHolderCode, $newValue, $url);
        return $newUrl;
    }

}
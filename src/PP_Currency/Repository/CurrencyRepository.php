<?php

namespace PP_Currency\Repository;

use PP_Currency\Helpers\ToolsHelper as Tools;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    protected $app;
    protected $rates = array();
    protected $session;
    protected $config;

    public function __construct($app)
    {
        $this->app = $app;
        $this->config  = $app['config'];
        $this->session = $app['session'];
    }

    public function getLatestRates($url)
    {
        $latestRates = $this->getJson($url);
        return $latestRates;
    }
    
    protected function getJson($url)
    {
        $transporter = $this->app['transporter'];
        $requestRes = $transporter->get($url);
        
        $result = json_decode($requestRes, true);
        $info = $transporter->getInfo();
        $transporter->close();
        if ($info['http_code'] != 200) {
            $message = isset($result['message']) ? $result['message'] : 'General rates error';
            throw new \Exception($message);
        }
        return $result;
    }
}
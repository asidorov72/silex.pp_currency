<?php
namespace PP_Currency\Transporter;

/**
 * Generic class that will perform curl requests
 * Class Curl
 * @package Colosseum\Transporter
 */
class Curl implements TransporterInterface
{
    private $handler;
    private $opts = array();
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    private function getHandler()
    {
        if (!is_null($this->handler)) {
            return $this->handler;
        }

        $this->handler = curl_init();
        if (!$this->handler) {
            throw new \Exception('cURL session cannot be created');
        }

        return $this->handler;
    }

    /**
     * Execute the request
     * @return string
     * @throws \Exception
     */
    public function exec()
    {
        $handler = $this->getHandler();

        $result = curl_exec($handler);

        if($this->app['config']['curl_request_debug'] == 1) {
            $this->debug();
        }

        return $result;
    }

    /**
     * Debug the request
     * @return array
     */
    public function debug()
    {   
        echo '<pre>';
        print_r($this->getInfo());
        echo '</pre>';
    }

    /**
     * Set curl specific option like these starting with CURLOPT_*
     * @param integer $key
     * @param string $value
     * @return $this
     */
    public function setOpt($key, $value)
    {
        $this->opts[$key] = $value;
        curl_setopt($this->getHandler(), $key, $value);
        return $this;
    }

    /**
     * Get curl option that was previously set with setOpt($key, $value)
     * @param integer $key
     * @return mixed
     */
    public function getOpt($key)
    {
        if (isset($this->opts[$key])) {
            return $this->opts[$key];
        }
    }

    /**
     * Free current curl resource previously created with curl_init()
     */
    public function close()
    {
        $handler = $this->getHandler();
        if (is_resource($handler)) {
            $this->handler = null;
            curl_close($handler);
        }
    }

    public function getInfo()
    {
        $info = curl_getinfo($this->getHandler());
        return $info;
    }
    
    public function getContent($url) {
        $result = file_get_contents($url);
        //var_dump($result);
        return $result;
    }
    
    public function get($url)
    {   
        $this
            ->setOpt(CURLOPT_URL, $url)    
            ->setOpt(CURLOPT_RETURNTRANSFER, true)
            ->setOpt(CURLOPT_CONNECTTIMEOUT , $this->app['config']['curl_connect_timeout'])
            ->setOpt(CURLOPT_TIMEOUT, $this->app['config']['curl_request_timeout'])
            ->setOpt(CURLOPT_PROXYAUTH, CURLAUTH_NTLM)
            ->setOpt(CURLOPT_PROXY, $this->app['config']['curl_proxy']);
            /*->setOpt(CURLOPT_FOLLOWLOCATION, false);*/
        
        $result = $this->exec();
        return $result;
    }

    public function post($url, $data)
    {
        $this
            ->setOpt(CURLOPT_SSL_VERIFYPEER, 0)
            ->setOpt(CURLOPT_CONNECTTIMEOUT , $this->app['config']['curl_connect_timeout'])
            ->setOpt(CURLOPT_TIMEOUT, $this->app['config']['curl_request_timeout'])
            ->setOpt(CURLOPT_URL, $url)
            ->setOpt(CURLOPT_POST, count($data))
            ->setOpt(CURLOPT_POSTFIELDS, http_build_query($data))
            ->setOpt(CURLOPT_RETURNTRANSFER, true);

        $result = $this->exec();
        return $result;
    }

    public function postJson($url, $data)
    {
        $this
            ->setOpt(CURLOPT_SSL_VERIFYPEER, 0)
            ->setOpt(CURLOPT_CONNECTTIMEOUT , $this->app['config']['curl_connect_timeout'])
            ->setOpt(CURLOPT_TIMEOUT, $this->app['config']['curl_request_timeout'])
            ->setOpt(CURLOPT_HEADER, false)
            ->setOpt(CURLOPT_URL, $url)
            ->setOpt(CURLOPT_HTTPHEADER, array("Content-type: application/json"))
            ->setOpt(CURLOPT_POST, true)
            ->setOpt(CURLOPT_POSTFIELDS, json_encode($data))
            ->setOpt(CURLOPT_RETURNTRANSFER, true);

        $result = $this->exec();
        return $result;
    }
}
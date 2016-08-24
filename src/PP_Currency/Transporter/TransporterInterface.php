<?php
namespace PP_Currency\Transporter;

interface TransporterInterface
{
    public function exec();
    public function setOpt($key, $value);
    public function getOpt($key);
    public function close();
    public function getInfo();
    public function post($url, $params);
    public function get($url);
    public function getContent($url);
}
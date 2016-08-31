<?php
namespace PP_Currency\Helpers;

class ToolsHelper
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
     * The static method gets associative array contains currency rates and returns an associative array with currency codes only.
     * 
     * array (size=3)
     *     'base' => string 'BGN' (length=3)
     *     'date' => string '2016-08-08' (length=10)
     *     'rates' => 
     *         array (size=31)
     *           'AUD' => float 0.74241
     *           'BRL' => float 1.8018
     *           'CAD' => float 0.74512
     *           'CHF' => float 0.55645
     * ...
     * 
     * @param $latestRatesByBase array - associative array contains currency rates
     * @returns associative array with currency codes only:
     * array (size=2)
     *           'AUD' => 'AUD'
     *           'BRL' => 'BRL'
     */
    public static function getCurrencyCodes ($latestRatesByBase) 
    {    
        if(!isset($latestRatesByBase['rates']) || !preg_match('/^[A-Z]{3}$/', strtoupper(key($latestRatesByBase['rates'])))) {
            return $latestRatesByBase;
        }
        $codesArray = array();
        foreach($latestRatesByBase['rates'] as $key => $val) {
            $codesArray[$key] = $key;
        }
        return $codesArray;
    }
    
    /*
     * This static method receives by referrence an associative array and adds to it a new element.
     * 
     * @param array &$currArray
     * @param array $newElement
     * returns by referrence a sorted array with the new element
     */
    public static function addAssocElement(&$currArray, $newElement = array('key' => "", 'value' => "")) 
    {        
        $currArray[$newElement['key']] = $newElement['value'];
        asort($currArray);
    }
    
    /**
     * This function divides integer value by commas. F.e. 
     * 
     * @param float $number
     * @param bool $fractional
     * @return float
     */
    function formatMoney($number, $fractional=false)
    { 
        if ($fractional) {
            $number = sprintf('%.2f', $number); 
        } 
        while (true) { 
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
            if ($replaced != $number) { 
                $number = $replaced; 
            } else { 
                break; 
            } 
        } 
        return $number; 
    } 
    
}
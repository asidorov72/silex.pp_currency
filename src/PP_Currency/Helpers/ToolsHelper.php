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
    
    
    
    
    
/*
    public function getLoginPage($redirectTo)
    {
        $loginPage = $this->app['config']['urls']['loginpage'][$this->channel];
        $loginPage .= '?vendor_id=' . $this->user->getVendorId() . '&language=' . $this->language . '&return_to=' . $redirectTo;
        return $loginPage;
    }

    public function getLoginPageWithOptinRedirect($promotionId)
    {
        $redirectTo = urlencode($this->getChannel() . '/optin/' . $promotionId);
        $loginPageUrl = $this->getLoginPage($redirectTo);
        return $loginPageUrl;
    }

    public function getOptinBtnHref($isUserLoggedIn)
    {
        if ($isUserLoggedIn) {
            return $this->getChannel() . '/optin/{promo_id}';
        }
        return $this->app['config']['urls']['loginpage'][$this->channel];
    }

    public function getDepositBtnHref($isUserLoggedIn)
    {
        if ($isUserLoggedIn) {
            return $this->app['config']['urls']['depositpage'][$this->channel];
        }
        return $this->app['config']['urls']['loginpage'][$this->channel];
    }

    public function getOptinPageUrl($promotionId)
    {
        $optinPageUrl = $this->getChannel() . '/optin/' . $promotionId;
        return $optinPageUrl;
    }

    public function getDepositPageUrl($promotionId)
    {
        $vendorId = $this->user->getVendorId();
        $depositPageUrl = $this->app['config']['urls']['depositpage'][$this->channel];
        return str_replace(
            array('{vendor_id}', '{promo_id}'),
            array($vendorId, $promotionId),
            $depositPageUrl
        );
    }

    public function getPromoPageUrl($promotionId)
    {
        $promoPageUrl = $this->getChannel() . '/promo/' . $promotionId;
        return $promoPageUrl;
    }

    public function openExternal($url)
    {
        return '<script>location.href="'.$url.'";</script>';
    }

    public function getChannel()
    {
        return '/' . $this->channel;
    }

    public function getRequestToken()
    {
        if ($this->request->query->has('token')) {
            return $this->request->query->get('token');
        } elseif ($this->request->attributes->has('token')) {
            return $this->request->attributes->get('token');
        }
        return null;
    }

    public function getCookieToken()
    {
        $tokenCookieNames = array(
            'ac_tkn',
            'PP_LOGIN',
            'PP_Login'
        );

        foreach ($tokenCookieNames as $cookieName) {
            $tokenCookie = trim($this->request->cookies->get($cookieName));

            if (strlen($tokenCookie) > 0) {
                switch ($cookieName) {
                    case 'ac_tkn':
                        $tokenCookieStr = urldecode($tokenCookie);
                        $tokenCookieArr = explode("|", $tokenCookieStr);
                        $tokenCookie    = $tokenCookieArr[0];
                        break;
                    case 'PP_LOGIN':
                    case 'PP_Login':
                        $tokenCookie = urldecode($tokenCookie);
                        break;
                }
                return  $tokenCookie;
            }
        }
        return null;
    }

    public function getCurrentAction()
    {
        $requestUriArray = explode("_", $this->request->get('_route'));
        $resAction = ( !empty($requestUriArray[2]) ) ? $requestUriArray[2] : null; 
        return $resAction;
    }

    public function getRequestParam($paramName)
    {
        if ($this->request->query->has($paramName)) {
            return $this->request->query->get($paramName);
        } elseif ($this->request->attributes->has($paramName)) {
            return $this->request->attributes->get($paramName);
        }
        return null;
    }

    
    public function getSessionTimeout($sessTimeout) 
    {
        if (!$this->session->has('start_time')) {
            $this->session->set('start_time', time());
        }
       
        $total_time = max(time() - $this->session->get('start_time'), 0);
        $seconds    = intval($total_time % 60);

        if ($seconds >= $sessTimeout) {
            $this->session->remove('start_time');
            return false;
        }
        return true;
    }
    */

}
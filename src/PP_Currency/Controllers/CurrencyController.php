<?php

namespace PP_Currency\Controllers;

use PP_Currency\Helpers\UrlHelper,
    PP_Currency\Helpers\ToolsHelper;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CurrencyController
{
    protected $app;
    protected $twig;
    protected $request;
    protected $config;
    protected $session;

    public function __construct($app)
    {
        $this->app     = $app;
        $this->twig    = $app['twig'];
        $this->request = $app['request'];
        $this->config  = $app['config'];
        $this->session = $app['session'];
        $this->session->noscript = false;
    }

    /*
     * GET http://api.fixer.io/latest
     * GET http://api.fixer.io/latest?base=USD
     * base should have a Currency code
     */
    public function index()
    {
        //echo "<noscript>" . $this->session->noscript = true . "</noscript>";
        
        //var_dump($this->request->query->get('nojs'));
        //var_dump($this->request->query);
        
        $nojs = $this->request->query->get('nojs');
        
        if (isset($nojs) && $nojs == '1') {
            $this->session->noscript = true;
        }
        
        $latestRatesByBaseUrl = UrlHelper::replaceParams(
                $this->config['GET_REQUEST_URL']['rates_by_base'],
                array('{CURRENCY_CODE}'), 
                array($this->config['default_base_code'])
            );
        
            //var_dump($noJS);

        $resultRates         = array();
        $requestRes          = array();
        $requestRes['rates'] = array();
        $alerts              = array();
        $errors              = array();
        
        $currencyRepository  = $this->getCurrencyRepository();
        
        if($this->request->cookies->has("RATES_CODES") === false){
            $ratesCodesList  = ToolsHelper::getCurrencyCodes(
                $currencyRepository->getLatestRates($latestRatesByBaseUrl)
            );
            ToolsHelper::setCookie("RATES_CODES", serialize($ratesCodesList), strtotime("+1 year"));
        } else {
            $ratesCodesList = unserialize($this->request->cookies->get('RATES_CODES'));
            //var_dump($this->request->cookies->get("RATES_CODES"));
        }
    
        ToolsHelper::addAssocElement($ratesCodesList, array(
                'key' => $this->config['default_base_code'], 'value' => $this->config['default_base_code'])
            );
        ToolsHelper::addCurrencyName($ratesCodesList, $this->config['currencies_JSON']);
        /*** FORM :: begin ***/
        
        /*
         * Default values for the form elements
         */
        $data = array(
            'amount' => '1',
            'ratesDate' => date("d/m/Y")
        );
        
        //var_dump($this->session->noscript);
        //var_dump($this->session);

        $form = $this->app['form.factory']->createBuilder('form', $data, array('csrf_protection' => false))
            ->add('amount', 'text', array(
                    'label' => 'Amount:',
                    'required' => true,
                    'attr' => array('class' => 'wrapper')
                )
            )
            ->add('refresh', 'button', array(
                'attr' => array(
                ))
            )
            ->add('ratesDate', 'text', array(
                    'label' => ' ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'wrapper ratesDateInput',
                        'readonly' => 'readonly'
                    )
                )
            )
            ->add('currencyFrom', 'choice', array(
                /*'placeholder' => 'Select Currency',*/
                'choices' => $ratesCodesList,
                'required' => true,
                'label' => 'Currency I Have:',
                'data' => $this->config['default_base_code'],
                'expanded' => false
            ))
            ->add('exchange', 'button', array(
                'attr' => array(
                ))
            )
            ->add('currencyTo', 'choice', array(
                /*'placeholder' => 'Select Currency',*/
                'choices' => $ratesCodesList,
                'label' => 'Currency I Want:',
                'required' => true,
                'expanded' => false
            ))
            ->add('convert', 'submit',  array('label' => 'Convert'))
            ->getForm();
        
        $form->handleRequest($this->request);

        $errors = $this->app['validator']->validate($form->get('amount')->getData(), 
               array(
                   new Assert\Regex(array(
                           'pattern' => '/^[0-9]\d*$/',
                           'message' => 'Please use only positive numbers.'
                       )
                   ), 
                   new Assert\NotEqualTo(0)
               )
           );

        if ($form->isSubmitted() && $form->isValid()) {
            if (!count($errors)) {
                $resultRates = $form->getData();
                
                //var_dump($resultRates);
                
                ToolsHelper::formatDate($resultRates['ratesDate']);
                
                //var_dump($resultRates['ratesDate']);
                
                $latestRatesByCodes = UrlHelper::replaceParams(
                    $this->config['GET_REQUEST_URL']['rates_by_date_base_and_codes'],
                    array('{yyyy-mm-dd}','{CURRENCY_CODE}','{COMMA_SEP_CODES}'),
                    array($resultRates['ratesDate'], $resultRates['currencyFrom'], $resultRates['currencyTo'])
                );
                $requestRes = $currencyRepository->getLatestRates($latestRatesByCodes);
                
                $ratesToOutput = $this->calculateRates(
                        $resultRates['amount'], 
                        $requestRes['rates'][$resultRates['currencyTo']], 
                        $resultRates['currencyFrom'], 
                        $resultRates['currencyTo'],
                        $resultRates['ratesDate']
                    );
                //$alerts['notice'][] = $ratesToOutput;
                $alerts['rates'][] = $ratesToOutput;
            } else {
                foreach ($errors as $error) {
                    //$alerts[] = $error->getPropertyPath().' '.$error->getMessage()."\n";
                    $alerts['alert'][] = $error->getMessage();
                }
            }
            /* AJAX output :: begin */
            if ($this->session->noscript === false) {
                echo json_encode($alerts);
                exit();
            }
            /* AJAX output :: end   */
            $this->session->getFlashBag()->add( 'alerts', $alerts );
        }
            
        /*** FORM :: end ***/
        
        return $this->twig->render(
            '/index.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    protected function getCurrencyRepository()
    {
        return $this->app['currency.repository'];
    }
    
    protected function calculateRates($amount, $crncyToValue, $crncyFromCode, $crncyToCode, $ratesDate)
    {
        $outputRates = '';
        //$calcRates = number_format($amount * $crncyTo, 2);
        $calcRates = ToolsHelper::formatMoney($amount * $crncyToValue, true);
        $outputRates = '<h5>' . $amount . ' <span>' . $crncyFromCode . '</span> = ' . $calcRates . ' <span>' . $crncyToCode . '</span></h5>';
        $outputRates .= '<span>1 ' . $crncyFromCode . ' = ' . $crncyToValue . ' ' . $crncyToCode . '</span>';
        $outputRates .= ' /<span>' . date_format(date_create($ratesDate),"D, d M Y") . '</span>/';
        return $outputRates;
    }
}
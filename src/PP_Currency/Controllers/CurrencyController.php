<?php

namespace PP_Currency\Controllers;

use PP_Currency\Helpers\UrlHelper,
    PP_Currency\Helpers\ToolsHelper;

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
        $this->app = $app;
        $this->twig = $app['twig'];
        $this->request = $app['request'];
        $this->config  = $app['config'];
        $this->session = $app['session'];
    }

    /*
     * GET http://api.fixer.io/latest
     * GET http://api.fixer.io/latest?base=USD
     * base should have a Currency code
     */
    public function index()
    {
        $latestRatesByBaseUrl = UrlHelper::replaceParams(
                $this->config['GET_REQUEST_URL']['rates_by_base'],
                array('{CURRENCY_CODE}'), 
                array($this->config['default_base_code'])
            );

        $resultRates         = array();
        $requestRes          = array();
        $requestRes['rates'] = array();
        $alerts              = array();
        $errors              = array();
        
        $currencyRepository  = $this->getCurrencyRepository();
        $ratesCodesList      = ToolsHelper::getCurrencyCodes(
                $currencyRepository->getLatestRates($latestRatesByBaseUrl)
            );
        ToolsHelper::addAssocElement($ratesCodesList, array('key' => $this->config['default_base_code'], 'value' => $this->config['default_base_code']));
        
        /*** FORM :: begin ***/
        
        /*
         * Default values for the form elements
         */
        $data = array(
            'amount' => '1'
        );

        $form = $this->app['form.factory']->createBuilder('form', $data, array('csrf_protection' => false))
            ->add('amount', 'text', array(
                    'required' => true,
                    'attr' => array('class' => 'wrapper')
                )
            )
            ->add('currencyFrom', 'choice', array(
                'placeholder' => 'Select Currency',
                'choices' => $ratesCodesList,
                'required' => true,
                'data' => $this->config['default_base_code'],
                'expanded' => false
            ))
            ->add('currencyTo', 'choice', array(
                'placeholder' => 'Select Currency',
                'choices' => $ratesCodesList,
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
                
                $latestRatesByCodes = UrlHelper::replaceParams(
                    $this->config['GET_REQUEST_URL']['rates_by_base_and_codes'],
                    array('{CURRENCY_CODE}','{COMMA_SEP_CODES}'),
                    array($resultRates['currencyFrom'], $resultRates['currencyTo'])
                );
                $requestRes = $currencyRepository->getLatestRates($latestRatesByCodes);
                
                $ratesToOutput = $this->calculateRates(
                        $resultRates['amount'], 
                        $requestRes['rates'][$resultRates['currencyTo']]
                    );
                $alerts['notice'][] = $ratesToOutput;
            } else {
                foreach ($errors as $error) {
                    //$alerts[] = $error->getPropertyPath().' '.$error->getMessage()."\n";
                    $alerts['alert'][] = $error->getMessage();
                }   
            }   
            $this->session->getFlashBag()->add( 'alerts', $alerts );
        }
            
        /*** FORM :: end ***/
        
        return $this->twig->render(
            '/index.html.twig',
            array(
                'resultRates' => $resultRates,
                'form' => $form->createView()
            )
        );
    }

    protected function getCurrencyRepository()
    {
        return $this->app['currency.repository'];
    }
    
    protected function calculateRates($amount, $crncyTo)
    {
        $calcRates = 0;
        //$calcRates = number_format($amount * $crncyTo, 2);
        $calcRates = ToolsHelper::formatMoney($amount * $crncyTo, true);
        return $calcRates;
    }
}
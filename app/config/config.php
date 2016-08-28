<?php

/**
 * Configuration settings 
 * (DO NOT REMOVE THE COMMENTS !!!!!)
 * 
 * 'curl_proxy'  => 'cntlm-proxy:3128' or null
 */
return array(
	'GET_REQUEST_URL' => array(
			'latest_rates'   => 'http://api.fixer.io/latest',
			'rates_by_date'  => 'http://api.fixer.io/{yyyy-mm-dd}',
			'rates_by_base'  => 'http://api.fixer.io/latest?base={CURRENCY_CODE}',
			'rates_by_codes' => 'http://api.fixer.io/latest?symbols={COMMA_SEP_CODES}',
            'latest_rates_cross_domains' => 'http://api.fixer.io/latest?callback=?'
		),
    'SSL_GET_REQUEST_URL' => array(
            'latest_rates'   => 'https://api.fixer.io/latest',
            'rates_by_date'  => 'https://api.fixer.io/{yyyy-mm-dd}',
            'rates_by_base'  => 'https://api.fixer.io/latest?base={CURRENCY_CODE}',
            'rates_by_codes' => 'https://api.fixer.io/latest?symbols={COMMA_SEP_CODES}',
            'latest_rates_cross_domains' => 'https://api.fixer.io/latest?callback=?'
		),
    'default_base_code' => 'BGN',
	'controller'  => '',
    'curl_connect_timeout' => 30,
    'curl_request_timeout' => 200,
    'curl_proxy' => null,
    'curl_request_debug'   => 0
);






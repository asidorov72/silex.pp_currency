<?php
namespace PP_Currency\Repository;

interface CurrencyRepositoryInterface {
    public function getLatestRates($url);
}
<?php

namespace App\Services;

use App\Entity\Product;
use App\Repository\CountryRepository;

class CalculateResultPrice
{
    public function __construct(private readonly CountryRepository $countryRepository)
    {

    }

    /**
     * @param string $taxNumber
     * @param Product $selectedProduct
     * @return array
     */
    public function calculateResult(string $taxNumber, Product $selectedProduct): array
    {
        $countryFromTaxNumber = $this->countryRepository
            ->findOneByCountryCode(substr($taxNumber, 0, 2));

        $selectedProductPrice = $selectedProduct->getPrice();
        $countryTax = $countryFromTaxNumber->getCountryTax();

        $resultPrice = (float)$selectedProductPrice + (float)$countryTax;
        $resultCountry = $countryFromTaxNumber->getCountryName();
        return ['result_price' => $resultPrice, 'result_country' => $resultCountry];
    }
}
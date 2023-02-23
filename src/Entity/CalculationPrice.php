<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppAssert;

class CalculationPrice
{

    #[AppAssert\IsValidTaxNumber()]
    #[Assert\NotBlank]
    private $tax_number;

    private Product $product;

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->tax_number;
    }

    /**
     * @param string $tax_number
     */
    public function setTaxNumber(string $tax_number): void
    {
        $this->tax_number = $tax_number;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
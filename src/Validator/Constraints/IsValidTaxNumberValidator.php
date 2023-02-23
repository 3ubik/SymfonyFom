<?php

namespace App\Validator\Constraints;

use App\Repository\CountryRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


#[\Attribute]
class IsValidTaxNumberValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CountryRepository $countryRepository)
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $countryCodeFromInput = $this->countryRepository
            ->findOneByCountryCode(substr($value, 0, 2));

        if ($countryCodeFromInput !== null) {
            $taxNumbers = substr($value, 2);
            if (!is_numeric($taxNumbers) || strlen($taxNumbers) !== 9) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%string%', $value)
                    ->addViolation();
            }

        }
    }
}
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
        $validationResult = true;
        if (null === $value || '' === $value) {
            return;
        }

        $countryCodeFromInput = $this->countryRepository
            ->findOneByCountryCode(substr($value, 0, 2));

        if (isset($countryCodeFromInput)) {
            $taxNumbers = substr($value, 2);
            if (!is_numeric($taxNumbers) || strlen($taxNumbers) !== 9) {
                $validationResult = false;
            }
        } else {
            $validationResult = false;
        }

        if(!$validationResult){
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
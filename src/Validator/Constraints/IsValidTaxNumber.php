<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidTaxNumber extends Constraint
{
    public string $message = 'Country code must be valid and in UPPERS CASE, There must be only 9 digits in the tax number ';
}
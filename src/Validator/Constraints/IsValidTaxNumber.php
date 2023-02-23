<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidTaxNumber extends Constraint
{
    public string $message = 'Tax number not valid';
}
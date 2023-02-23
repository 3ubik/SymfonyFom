<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidCountryCode extends Constraint
{
    public string $message = 'Make country code in Upper Case';
}
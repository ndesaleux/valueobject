<?php

namespace ndesaleux\valueObject\CreditCard;

use ndesaleux\valueObject\Exception;

class InvalidCreditCard extends Exception
{

    const INVALID_NUMBER = '"%s" must is a 16 digits string';
    const NOT_MATCHING_LUHN = '"%s" does not match luhn algorithm';

    public static function fromInvalidNumber($value)
    {
        return new self(sprintf(self::INVALID_NUMBER, $value));
    }

    public static function fromNotMatchingLuhnAlgorithm($value)
    {
        return new self(sprintf(self::NOT_MATCHING_LUHN, $value));
    }
}

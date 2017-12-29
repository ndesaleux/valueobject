<?php

namespace ndesaleux\valueObject\CreditCard;

use ndesaleux\valueObject\Luhn\InvalidLuhn;
use ndesaleux\valueObject\Luhn\Luhn;
use ndesaleux\valueObject\valueObject;

class CreditCard extends valueObject
{

    public function __construct($value)
    {
        if ($this->validate($value) === true) {
            $this->value = $value->value;
        }
    }

    /**
     * @param $value
     *
     * @return bool
     *
     * @throws InvalidCreditCard
     */
    protected function validate($value)
    {
        if (preg_match('[0-9]{16}', $value) !== 1) {
            throw InvalidCreditCard::fromInvalidNumber($value);
        }
        try {
            new Luhn($value);
        } catch (InvalidLuhn $exception) {
            throw InvalidCreditCard::fromNotMatchingLuhnAlgorithm($value);
        }
        return true;
    }
}

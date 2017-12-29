<?php

namespace ndesaleux\valueObject\French\SecuriteSociale;

use ndesaleux\valueObject\Exception;

class InvalidNumber extends Exception
{
    const NOT_MATCHING_PATTERN = '"%s" does not match pattern';
    const WRONG_NIR = '"97 - (%d %%97)" different from %d';

    /**
     * @param string $number
     *
     * @return InvalidNumber
     */
    public static function fromNotMatchingPattern($number)
    {
        return new self(sprintf(self::NOT_MATCHING_PATTERN, $number));
    }

    /**
     * @param (int) $nir
     * @param (int) $value
     *
     * @return InvalidNumber
     */
    public static function fromWrongNIR($nir, $value)
    {
        return new self(sprintf(self::WRONG_NIR, $value, $nir));
    }
}

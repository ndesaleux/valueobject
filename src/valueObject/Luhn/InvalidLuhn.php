<?php

namespace ndesaleux\valueObject\Luhn;

use ndesaleux\valueObject\Exception;

class InvalidLuhn extends Exception
{

    const NO_NUMERICAL = '"%s" contains no numerical character, Luhn algorithm works on numerical string';

    const INVALID_CHECKSUM = '"%s" is invalid cause checksum %d modulo 10 is different from 0';

    /**
     * @param string $value
     * @param int    $checksum
     *
     * @return InvalidLuhn
     */
    public static function fromValueWithInvalidChecksum($value, $checksum)
    {
        return new self(sprintf(self::INVALID_CHECKSUM, $value, $checksum));
    }

    /**
     * @param string $value
     *
     * @return InvalidLuhn
     */
    public static function fromNoNumerical($value)
    {
        return new self(sprintf(self::NO_NUMERICAL, $value));
    }
}

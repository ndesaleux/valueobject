<?php

namespace ndesaleux\valueObject\IP;

use ndesaleux\valueObject\Exception;

class InvalidIP extends Exception
{

    const INVALID_VALUE = '"%s" is not a valid IP';

    /**
     * @param string          $value
     * @param int             $code
     * @param \Throwable|null $previous
     *
     * @return InvalidIP
     */
    public static function fromInvalidValue($value, $code = 0, \Throwable $previous = null)
    {
        return new self(sprintf(self::INVALID_VALUE, (string) $value), $code, $previous);
    }
}

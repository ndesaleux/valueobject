<?php

namespace ndesaleux\valueObject\Email;

use ndesaleux\valueObject\Exception;

class InvalidEmail extends Exception
{
    const INVALID_VALUE = 'email "%s" is invalid';

    public static function fromValue($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf(self::INVALID_VALUE, $value),
            $code,
            $previous
        );
    }
}

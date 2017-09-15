<?php

namespace ndesaleux\valueObject\Geographical\ZipCode;


class InvalidZipCode extends \Exception
{
    const WRONG_TYPE = '"%s" has type "%s", "%s" required';

    const WRONG_FORMAT = '"%s" has wrong format';

    public static function fromWrongType($value, $currentType, $neededType, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf(self::WRONG_TYPE, $value, $currentType, $neededType),
            $code,
            $previous
        );
    }

    public static function fromInvalidFormat($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf(self::WRONG_FORMAT, $value),
            $code,
            $previous
        );
    }
}

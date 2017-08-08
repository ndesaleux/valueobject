<?php

namespace ndesaleux\valueObject\Geographical\ZipCode;


class InvalidZipCode extends \Exception
{
    public static function fromWrongType($value, $currentType, $neededType, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf('"%s" has type "%s", "%s" required', $value, $currentType, $neededType),
            $code,
            $previous
        );
    }

    public static function fromInvalidFormat($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf('"%s" has wrong format', $value),
            $code,
            $previous
        );
    }
}

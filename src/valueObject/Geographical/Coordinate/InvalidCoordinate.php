<?php

namespace ndesaleux\valueObject\Geographical\Coordinate;

class InvalidCoordinate extends \Exception
{
    const NUMERICAL_VALUE_NEEDED = 'Coordinate must be init with numerical value, "%s" was not';

    const OUT_OF_RANGE = '"%s" was out of range';

    public static function fromNotNumerical($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf(self::NUMERICAL_VALUE_NEEDED, $value),
            $code,
            $previous
        );
    }

    public static function fromOutOfRange($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            sprintf(self::OUT_OF_RANGE, $value),
            $code,
            $previous
        );
    }
}

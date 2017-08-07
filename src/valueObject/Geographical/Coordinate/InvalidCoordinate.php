<?php

namespace ndesaleux\valueObject\Geographical\Coordinate;

class InvalidCoordinate extends \Exception
{
    public static function fromNotNumerical($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            'Coordinate must be init with numerical value, "' .$value. '" was not',
            $code,
            $previous
        );
    }

    public static function fromOutOfRange($value, $code = 0, \Throwable $previous = null)
    {
        return new self(
            'Coordinate must be init with value beetwen -90 and 90, "' .$value. '" was not',
            $code,
            $previous
        );
    }
}

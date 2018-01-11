<?php

namespace ndesaleux\valueObject\Geographical\Coordinate;

use ndesaleux\valueObject\ValueObject;

abstract class Coordinate extends ValueObject
{
    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    protected function validate($value)
    {
        if (!is_numeric($value)) {
            throw InvalidCoordinate::fromNotNumerical($value);
        }

        if ($value > static::MAX_VALUE || $value < -(static::MAX_VALUE)) {
            throw InvalidCoordinate::fromOutOfRange($value);
        }
        return true;
    }
}

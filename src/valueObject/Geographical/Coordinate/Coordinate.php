<?php

namespace ndesaleux\valueObject\Geographical\Coordinate;

abstract class Coordinate
{
    private $value;

    public function __construct($value)
    {
        if (!is_numeric($value)) {
            throw InvalidCoordinate::fromNotNumerical($value);
        }

        if ($value > static::MAX_VALUE || $value < -(static::MAX_VALUE)) {
            throw InvalidCoordinate::fromOutOfRange($value);
        }

        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

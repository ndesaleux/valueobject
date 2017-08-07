<?php

namespace ndesaleux\valueObject\Geographical\Coordinate;

class Coordinate
{
    private $value;

    public function __construct($value)
    {
        if (!is_numeric($value)) {
            throw InvalidCoordinate::fromNotNumerical($value);
        }

        if ($value > 90 || $value < -90) {
            throw InvalidCoordinate::fromOutOfRange($value);
        }

        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

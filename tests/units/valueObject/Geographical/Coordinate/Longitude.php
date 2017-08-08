<?php

namespace tests\units\ndesaleux\valueObject\Geographical\Coordinate;

use ndesaleux\valueObject\Geographical\Coordinate\InvalidCoordinate;

class Longitude extends \atoum
{
    public function testLongitudeWithValidValue()
    {
        $this
            ->given($value = (float) rand(-180, 180))
            ->and($this->newTestedInstance($value))
            ->float($this->testedInstance->getValue())
                ->isEqualTo($value);
    }

    public function testLongitudeThrowedExceptionWithNotNumericalValue()
    {
        $this
            ->given($value = uniqid('value'))
            ->exception(function () use ($value) { $this->newTestedInstance($value);})
                ->hasMessage('Coordinate must be init with numerical value, "' . $value . '" was not')
                ->isInstanceOf(InvalidCoordinate::class);
    }

    public function testLongitudeThrowedExceptionWithOutOfRangeValueMax()
    {
        $this
            ->given($value = rand(181, PHP_INT_MAX))
            ->exception(function () use ($value) { $this->newTestedInstance($value);})
                ->hasMessage('"' . $value . '" was out of range')
                ->isInstanceOf(InvalidCoordinate::class);
    }

    public function testLongitudeThrowedExceptionWithOutOfRangeValueMin()
    {
        $this
            ->given($value = rand(PHP_INT_MIN, -181))
            ->exception(function () use ($value) { $this->newTestedInstance($value);})
            ->hasMessage('"' . $value . '" was out of range')
            ->isInstanceOf(InvalidCoordinate::class);
    }
}

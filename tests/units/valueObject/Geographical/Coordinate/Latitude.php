<?php

namespace tests\units\ndesaleux\valueObject\Geographical\Coordinate;

use ndesaleux\valueObject\Geographical\Coordinate\InvalidCoordinate;

class Latitude extends \atoum
{
    public function testLatitudeWithValidValue()
    {
        $this
            ->given($value = (float) rand(-90, 90))
            ->and($this->newTestedInstance($value))
            ->float($this->testedInstance->getValue())
                ->isEqualTo($value);
    }

    public function testLatitudeThrowedExceptionWithNotNumericalValue()
    {
        $this
            ->given($value = uniqid('value'))
            ->exception(function () use ($value) { $this->newTestedInstance($value);})
                ->hasMessage('Coordinate must be init with numerical value, "' . $value . '" was not')
                ->isInstanceOf(InvalidCoordinate::class);
    }

    public function testLatitudeThrowedExceptionWithOutOfRangeValue()
    {
        $this
            ->given($value = rand(91, PHP_INT_MAX))
            ->exception(function () use ($value) { $this->newTestedInstance($value);})
                ->hasMessage('"' . $value . '" was out of range')
                ->isInstanceOf(InvalidCoordinate::class);
    }
}

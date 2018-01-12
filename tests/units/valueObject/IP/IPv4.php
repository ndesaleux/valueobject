<?php

namespace tests\units\ndesaleux\valueObject\IP;


use ndesaleux\valueObject\IP\InvalidIP;

class IPv4 extends \atoum
{
    //*
    public function testIPWithValidValue()
    {
        $this
            ->given($value = rand(1,255) . '.' .rand(1,255) . '.' . rand(1,255) . '.' . rand(1,255))
            ->and($this->newTestedInstance($value))
            ->string($this->testedInstance->value())
                ->isEqualTo($value);
    }

    public function testInvalidIP()
    {
        $this
            ->given($value = uniqid('ip'))
            ->exception(function() use ($value) {
                $this->newTestedInstance($value);
            })
                ->hasMessage(sprintf(InvalidIP::INVALID_VALUE, $value))
                ->isInstanceOf(InvalidIP::class);
    }

    public function testInvalidIPWithBorderLineValue($value)
    {
        $this
            ->exception(function() use ($value) {
                $this->newTestedInstance($value);
            })
            ->hasMessage(sprintf(InvalidIP::INVALID_VALUE, $value))
            ->isInstanceOf(InvalidIP::class);
    }

    protected function testInvalidIPWithBorderLineValueDataProvider()
    {
        return [
            '0.0.0.0',
            '0.256.0.0',
            '0.256.0.256',
            '0.256.256.0',
            '0.256.256.256',
            '0.0.256.0',
            '0.0.256.256',
            '0.0.0.256',
            '256.0.0.0',
            '256.0.256.0',
            '256.0.256.256',
            '256.0.0.256',
            '256.256.0.0',
            '256.256.0.256',
            '256.256.256.0',
            '256.256.256.256'
        ];
    }

    /*
    public function testInvalidIPWithOutOfRange()
    {
        $this
            ->given($value = rand(256, PHP_INT_MAX) . '.' . rand(256, PHP_INT_MAX) . '.' . rand(256, PHP_INT_MAX) . '.' . rand(256, PHP_INT_MAX))
            ->exception(function() use ($value) {
                $this->newTestedInstance($value);
            })
            ->hasMessage(sprintf(InvalidIP::INVALID_VALUE, $value))
            ->isInstanceOf(InvalidIP::class);
    }


    public function testIsBroadcastShouldReturnTrue()
    {
        $this
            ->given($value = '255.255.255.255')
            ->and($this->newTestedInstance($value))
            ->boolean($this->testedInstance->isBroadcast())
                ->isTrue();
    }

    public function testIsBroadcastShouldReturnFalse($value)
    {
        $this
            ->given($this->newTestedInstance($value))
            ->boolean($this->testedInstance->isBroadcast())
            ->isFalse();
    }

    protected function testIsBroadcastShouldReturnFalseDataProvider()
    {
        return [
            rand(1,255) . '.' . rand(1,254) . '.' . rand(1,254) . '.' . rand(1,254),
            rand(1,254) . '.' . rand(1,255) . '.' . rand(1,254) . '.' . rand(1,254),
            rand(1,254) . '.' . rand(1,254) . '.' . rand(1,255) . '.' . rand(1,254),
            rand(1,254) . '.' . rand(1,254) . '.' . rand(1,254) . '.' . rand(1,255),
            rand(1,255) . '.' . rand(1,255) . '.' . rand(1,254) . '.' . rand(1,255),
            rand(1,255) . '.' . rand(1,255) . '.' . rand(1,255) . '.' . rand(1,254),
            rand(1,255) . '.' . rand(1,254) . '.' . rand(1,255) . '.' . rand(1,254),
            rand(1,255) . '.' . rand(1,254) . '.' . rand(1,255) . '.' . rand(1,255),
            rand(1,255) . '.' . rand(1,255) . '.' . rand(1,255) . '.' . rand(1,254),
            rand(1,254) . '.' . rand(1,255) . '.' . rand(1,255) . '.' . rand(1,254),
            rand(1,254) . '.' . rand(1,255) . '.' . rand(1,255) . '.' . rand(1,254),
            rand(1,254) . '.' . rand(1,255) . '.' . rand(1,255) . '.' . rand(1,254),
        ];
    }

    public function testIsPrivate($value)
    {
        $this
            ->given($this->newTestedInstance($value))
            ->boolean($this->testedInstance->isPrivate())
                ->isTrue();
    }

    protected function testIsPrivateDataProvider()
    {
        return [
            '10.' . rand(0,255) . '.' . rand(0,255) . '.' . rand(0,255),
            '172.' . rand(16,31) . '.' . rand(0,255) . '.' . rand(0,255),
            '192.168.' . rand(0,255) . '.' . rand(0,255),
        ];
    }
    //*/
}

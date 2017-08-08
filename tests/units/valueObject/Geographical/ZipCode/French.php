<?php

namespace tests\units\ndesaleux\valueObject\Geographical\ZipCode;

class French extends \atoum
{
    public function testExtendsZipCode()
    {
        $this
            ->class(\ndesaleux\valueObject\Geographical\ZipCode\French::class)
                ->isSubclassOf(\ndesaleux\valueObject\Geographical\ZipCode\ZipCode::class);
    }

    public function testValidZipCode()
    {
        $this
            ->given($zipCode = rand(1000, 99999))
            ->and($this->newTestedInstance($zipCode))
                ->string($this->testedInstance->getValue())
                    ->isEqualTo((string) $zipCode);
    }

    public function testThrowInvalidZipCodeFromWrongType()
    {
        $this
            ->given($zipCode = uniqid('zipcode'))
            ->exception( function() use ($zipCode) { $this->newTestedInstance($zipCode);})
                ->hasMessage(sprintf('"%s" has type "%s", "%s" required', $zipCode, gettype($zipCode), 'integer'));
    }

    public function testThrowInvalidZipCodeFromWrongFormat()
    {
        $this
            ->given($zipCode = rand(PHP_INT_MIN, 999))
            ->exception( function() use ($zipCode) { $this->newTestedInstance($zipCode);})
                ->hasMessage(sprintf('"%s" has wrong format', $zipCode));
    }
}

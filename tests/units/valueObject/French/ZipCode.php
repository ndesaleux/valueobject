<?php

namespace tests\units\ndesaleux\valueObject\French;

class ZipCode extends \atoum
{
    public function testExtendsZipCode()
    {
        $this
            ->class(\ndesaleux\valueObject\French\ZipCode::class)
                ->isSubclassOf(\ndesaleux\valueObject\Geographical\ZipCode\ZipCode::class);
    }

    public function testValidZipCode()
    {
        $this
            ->given($zipCode = rand(1000, 99999))
            ->and($this->newTestedInstance($zipCode))
                ->string($this->testedInstance->value())
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

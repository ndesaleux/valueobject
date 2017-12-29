<?php

namespace tests\units\ndesaleux\valueObject\Email ;

use ndesaleux\valueObject\Email\InvalidEmail;

class Email extends \atoum
{
    public function testEmailWithValidValue()
    {
        $this
            ->given($user = uniqid('user'))
            ->and($domain = uniqid('domain') . '.com')
            ->and($value = $user . '@' . $domain)
            ->and($this->newTestedInstance($value))
            ->string($this->testedInstance->value())
                ->isEqualTo($value)
            ->string($this->testedInstance->getCanonical())
                ->isEqualTo($value)
            ->string($this->testedInstance->getDomain())
                ->isEqualTo($domain);
    }

    public function testEmailWithValidValueContainsSplit()
    {
        $this
            ->given($user = uniqid('user'))
            ->and($split = uniqid('split'))
            ->and($domain = uniqid('domain') . '.com')
            ->and($canonical = $user . '@' . $domain)
            ->and($value = $user . '+' . $split . '@' . $domain)
            ->and($this->newTestedInstance($value))
                ->string($this->testedInstance->value())
            ->isEqualTo($value)
            ->string($this->testedInstance->getCanonical())
                ->isEqualTo($canonical)
            ->string($this->testedInstance->getDomain())
                ->isEqualTo($domain);
    }

    public function testEmailThrowException()
    {
        $this
            ->given($value = uniqid('value'))
            ->exception(function () use ($value) { $this->newTestedInstance($value);})
                ->hasMessage('email "' . $value . '" is invalid')
                ->isInstanceOf(InvalidEmail::class);
    }
}

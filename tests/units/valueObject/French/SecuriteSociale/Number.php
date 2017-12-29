<?php
namespace tests\units\ndesaleux\valueObject\French\SecuriteSociale;

use ndesaleux\valueObject\French\SecuriteSociale\InvalidNumber;

class Number extends \atoum
{
    public function testRightNumber()
    {
        $this
            ->given($num = '181012B47803452')
            ->and( $this->newTestedInstance($num))
            ->string($this->testedInstance->value())
                ->isEqualTo($num);
    }

    public function testInvalidPattern()
    {
        $this
            ->given($num = uniqid('secu'))
                ->exception(function () use ($num) { $this->newTestedInstance($num);})
                    ->hasMessage('"' . $num . '" does not match pattern')
                    ->isInstanceOf(InvalidNumber::class);
    }

    public function testWrongNIR()
    {
        $this
            ->given($num = '181012B47803453')
            ->exception(function () use ($num) { $this->newTestedInstance($num);})
                ->hasMessage('"97 - (1810118478034 %97)" different from 53')
                ->isInstanceOf(InvalidNumber::class);
    }

    public function testProperties()
    {
        $this
            ->given($sex = substr('123478', rand(0,5), 1))
            ->and($year = $this->formatter(rand(0,99)))
            ->and($month = $this->formatter(rand(1,12)))
            ->and($dpt = $this->formatter(rand(1,19)))
            ->and($city = $this->formatter(rand(0,999),3))
            ->and($order = $this->formatter(rand(0,999),3))
            ->and($num = $sex . $year . $month . $dpt . $city . $order)
            ->and($nir = $this->formatter(97 - ($num%97)))
            ->and($this->newTestedInstance($num . $nir))
                ->boolean($this->testedInstance->isFemale())
                ->integer($this->testedInstance->getNIR())
                    ->isEqualTo($nir)
                ->string($this->testedInstance->getYear())
                    ->isEqualTo($year)
                ->string($this->testedInstance->getMonth())
                    ->isEqualTo($month)
                ->string($this->testedInstance->getDepartement())
                    ->isEqualTo($dpt)
                ->string($this->testedInstance->getCityNumber())
                    ->isEqualTo($city)
                ->string($this->testedInstance->getOrder())
                    ->isEqualTo($order);

        if ($sex%2 === 1) {
            $this
                ->boolean($this->testedInstance->isMale())
                    ->isTrue()
                ->boolean($this->testedInstance->isFemale())
                    ->isFalse();
        } else {
            $this
                ->boolean($this->testedInstance->isMale())
                    ->isFalse()
                ->boolean($this->testedInstance->isFemale())
                    ->isTrue();
        }
    }

    private function formatter($value, $default = 2)
    {
        return str_pad($value, $default, '0', STR_PAD_LEFT);
    }
}

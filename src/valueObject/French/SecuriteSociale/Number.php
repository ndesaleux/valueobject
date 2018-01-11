<?php

namespace ndesaleux\valueObject\French\SecuriteSociale;

use ndesaleux\valueObject\ValueObject;

class Number extends ValueObject
{

    private $infos;

    const PATTERN = '#(?P<sex>[1-478])(?P<year>\d{2})(?P<month>\d{2})((?P<departement1>9[78][0-9])(?P<city1>\d{2})|(?P<departement>(\d{2}|2[ab]))(?P<city>\d{3}))(?P<order>\d{3})(?P<nir>\d{2})#i'; // @codingStandardsIgnoreLine

    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    protected function validate($value)
    {
        if (preg_match(self::PATTERN, $value, $matches) !== 1) {
            throw InvalidNumber::fromNotMatchingPattern($value);
        }

        $calcul = str_replace(
            ['2a', '2b'],
            [19, 18],
            substr(
                strtolower($value),
                0,
                -2
            )
        );
        $this->infos = $matches;

        if ((97 - ($calcul%97)) !== $this->getNIR()) {
            throw InvalidNumber::fromWrongNIR($this->getNIR(), $calcul);
        }
        return true;
    }

    public function isMale()
    {
        return ((int) $this->infos['sex'] % 2 === 1);
    }

    public function isFemale()
    {
        return ((int) $this->infos['sex'] % 2 === 0);
    }

    public function getYear()
    {
        return $this->infos['year'];
    }

    public function getMonth()
    {
        return $this->infos['month'];
    }

    public function getDepartement()
    {
        if ($this->infos['departement'] === '') {
            return $this->infos['departement1'];
        }
        return $this->infos['departement'];
    }

    public function getCityNumber()
    {
        if ($this->infos['city'] === '') {
            return $this->infos['city1'];
        }
        return $this->infos['city'];
    }

    public function getOrder()
    {
        return $this->infos['order'];
    }

    public function getNIR()
    {
        return (int) $this->infos['nir'];
    }
}

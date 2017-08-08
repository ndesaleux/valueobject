<?php

namespace ndesaleux\valueObject\Geographical\ZipCode;


abstract class ZipCode
{
    protected $value;

    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    abstract public function validate($value);

    public function getValue()
    {
        return $this->value;
    }

}

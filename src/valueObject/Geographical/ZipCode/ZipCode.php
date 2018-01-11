<?php

namespace ndesaleux\valueObject\Geographical\ZipCode;

use ndesaleux\valueObject\ValueObject;

abstract class ZipCode extends ValueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }
}

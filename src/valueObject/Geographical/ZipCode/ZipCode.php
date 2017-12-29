<?php

namespace ndesaleux\valueObject\Geographical\ZipCode;


use ndesaleux\valueObject\valueObject;

abstract class ZipCode extends valueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

}

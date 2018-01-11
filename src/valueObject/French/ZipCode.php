<?php

namespace ndesaleux\valueObject\French;

use ndesaleux\valueObject\Geographical\ZipCode as Zip ;

class ZipCode extends Zip\ZipCode
{
    protected function validate($value)
    {
        if (! is_int($value)) {
            throw Zip\InvalidZipCode::fromWrongType($value, gettype($value), 'integer');
        }
        if ($value > 0 && strlen($value) >= 4 && strlen($value) <= 5) {
            return true;
        }
        throw Zip\InvalidZipCode::fromInvalidFormat($value);
    }

    public function value()
    {
        return str_pad($this->value, 5, '0', STR_PAD_LEFT);
    }
}

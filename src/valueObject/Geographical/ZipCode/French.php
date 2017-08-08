<?php

namespace ndesaleux\valueObject\Geographical\ZipCode;

class French extends ZipCode
{
    public function validate($value) {
        if (! is_int($value)) {
            throw InvalidZipCode::fromWrongType($value, gettype($value), 'integer');
        }
        if ($value > 0 && strlen($value) >= 4 && strlen($value) <= 5) {
            return true;
        }
        throw InvalidZipCode::fromInvalidFormat($value);

    }

    public function getValue()
    {
        return str_pad($this->value, 5, '0', STR_PAD_LEFT);
    }
}

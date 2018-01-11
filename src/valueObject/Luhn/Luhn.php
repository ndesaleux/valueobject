<?php

namespace ndesaleux\valueObject\Luhn;

use ndesaleux\valueObject\ValueObject;

class Luhn extends ValueObject
{

    /**
     * Luhn constructor.
     *
     * @param $value
     *
     * @throws InvalidLuhn
     */
    public function __construct($value)
    {
        if ($this->validate($value)) {
            $this->value = $value;
        }
    }

    /**
     * @param $value
     *
     * @return bool
     *
     * @throws InvalidLuhn
     */
    protected function validate($value)
    {
        $value = (string) $value;
        if (preg_match('[^0-9]', $value)) {
            throw InvalidLuhn::fromNoNumerical($value);
        }

        $length = strlen($value);
        $checksum = 0;

        // Luhn's algorithm
        for ($i = 0; $i < $length; $i++) {
            $int = (int) $value[$length - 1 - $i];
            if ($i%2 === 0) {
                $int *= 2;
                if ($int > 9) {
                    $int -= 9;
                }
            }
            $checksum += $int;
        }
        if ($checksum % 10 === 0) {
            return true;
        }

        throw InvalidLuhn::fromValueWithInvalidChecksum($value, $checksum);
    }
}

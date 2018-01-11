<?php

namespace ndesaleux\valueObject;

abstract class ValueObject
{
    protected $value;

    /**
     * @param mixed $value
     *
     * @return bool
     *
     * @throw Exception
     */
    abstract protected function validate($value);

    public function value()
    {
        return $this->value;
    }
}

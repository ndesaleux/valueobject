<?php

namespace ndesaleux\valueObject;

abstract class valueObject
{
    protected $value;

    /**
     * @param mixed $value
     *
     * @return bool
     *
     * @throw Exception
     */
    protected abstract function validate($value);

    public function value()
    {
        return $this->value;
    }
}

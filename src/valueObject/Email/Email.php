<?php

namespace ndesaleux\valueObject\Email;

use ndesaleux\valueObject\valueObject;

class Email extends valueObject
{

    private $domain;

    private $canonical;

    public function __construct($value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmail::fromValue($value);
        }
        $this->value = $value;
        $this->domain = explode('@', $value)[1];
        $this->canonical = preg_replace('/\+(.+)@/', '@', $value);
    }

    protected function validate($value)
    {

    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getCanonical()
    {
        return $this->canonical;
    }

}

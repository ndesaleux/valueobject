<?php

namespace ndesaleux\valueObject\Email;

class Email
{

    private $value;

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

    public function getValue()
    {
        return $this->value;
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

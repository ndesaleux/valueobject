<?php

namespace ndesaleux\valueObject\IP;


class IPv4
{
    private $value;
    private $intValue;

    private $privateRules = [
        ['min' => '10.0.0.0', 'max' => '10.255.255.255'],
        ['min' => '172.16.0.0', 'max' => '172.31.255.255'],
        ['min' => '192.168.0.0', 'max' => '192.168.255.255']
    ];

    public function __construct($value) {
        $this->intValue = ip2long($value);
        if (!$this->intValue) {
            throw InvalidIP::fromInvalidValue($value);
        }
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isPrivate()
    {
        foreach ($this->privateRules as $rule) {
            if ($this->intValue >= ip2long($rule['min']) && $this->intValue <= ip2long($rule['max']) ){
                return true;
            }
        }
        return false;
    }

    public function isBroadcast()
    {
        return $this->value === '255.255.255.255';
    }
}

<?php

namespace App\DB\Core;

abstract class Field
{
    public $value;
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public static function new()
    {
        return new static;
    }

    abstract public function execute();
}

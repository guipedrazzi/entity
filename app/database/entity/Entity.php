<?php

namespace app\database\entity;

class Entity
{
    protected array $attr = [];

    public function __set(string $property, mixed $value)
    {
        $this->attr[$property] = $value;
    }

    public function __get(string $property)
    {
        return $this->attr[$property];
    }

    public function getAttributes()
    {
        return $this->attr;
    }
}

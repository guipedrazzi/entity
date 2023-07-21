<?php

namespace app\database\entity;
use Exception;

class OwnerEntity extends Entity
{
    public function telephoneIsValid()
    {
        if(!isset($this->attr['tel1']))
        {
            throw new Exception('Telephone field does not exist');
        }

        return filter_var($this->attr['tel1']);
    }
}

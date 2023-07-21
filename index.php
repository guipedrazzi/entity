<?php

use app\database\entity\OwnerEntity;
use app\database\model\Owner;
use app\database\model\Property;

require 'vendor/autoload.php';

$owner = new Owner;
// $owners = $owner->all();
// var_dump($owners); 

$ownerEntity = new OwnerEntity;
$ownerEntity->name = 'Guilherme';
$ownerEntity->tel1 = '1232423123';
$ownerEntity->id_user_insert = 1;
$owner->create($ownerEntity);


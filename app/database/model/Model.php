<?php

namespace app\database\model;

use app\database\Connection;
use app\database\entity\Entity;
use Exception;
use PDO;
use ReflectionClass;

abstract class Model
{
    protected string $table;

    private function getEntity()
    {
        //essa classe padrão reflection é uma API do PHP para pegar informações das classes instanciadas.
        $reflect = new ReflectionClass(static::class); //esse static::class pega a classe que está instanciando
        $class = $reflect->getShortName(); //função para pegar o nome da class instanciada
        $entity = "app\\database\\entity\\{$class}Entity";

        if(!class_exists($entity)) //vejo se a classe existe já com base na URL do projeto
        {
            throw new Exception("Entity ".$entity."does not exist");
        }

       return $entity;
    }

    public function all(string $fields = "*")
    {
        try {
            $connection = Connection::getConnection();
            $query = "select {$fields} from {$this->table}";
            $stmt = $connection->query($query);

            return $stmt->fetchAll(PDO::FETCH_CLASS,$this->getEntity());
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function create(Entity $entity)
    {
        try {
            $connection = Connection::getConnection();
            $query = "INSERT INTO {$this->table}(";
            $query .= implode(',',array_keys($entity->getAttributes())).') VALUES ('; //montando a query pegando os keys do array da entity
            $query .= ':' . implode(',:', array_keys($entity->getAttributes())).")";
            $prepare = $connection->prepare($query);

            return $prepare->execute($entity->getAttributes());
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }
}

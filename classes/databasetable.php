<?php

namespace Classes;

use Exception;
use PDO;
use PDOException;

class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    private $className;
    private $constructorArgs;

    public function __construct(PDO $pdo, string $table, string $primaryKey, string $className = '\stdClass', array $constructorArgs = [])
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    public function findById($value)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :value";

        $stmt = $this->pdo->prepare($sql);

        $record = ['value' => $value];

        $stmt->execute($record);
        $object = $stmt->fetchObject($this->className, $this->constructorArgs);

        return $object;
    }

    public function find($field, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $field = :value";

        $stmt = $this->pdo->prepare($sql);

        $record = ['value' => $value];

        $stmt->execute($record);
        $row = $stmt->fetchAll(PDO::FETCH_CLASS, $this->className, $this->constructorArgs);

        return $row;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM $this->table";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_CLASS, $this->className, $this->constructorArgs);

        return $rows;
    }

    private function insert($record)
    {
        $keys = array_keys($record);

        $fields = implode(', ', $keys);
        $values = implode(', :', $keys);
        $sql = "INSERT INTO $this->table ($fields) VALUES (:$values)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($record);

        return $this->pdo->lastInsertId();
    }

    private function update($record)
    {
        $parameters = [];
        foreach ($record as $key => $value) {
            $parameters[] = $key . ' = :' . $key;
        }

        $fields = implode(', ', $parameters);
        $sql = "UPDATE $this->table SET $fields WHERE $this->primaryKey = :primaryKey";

        $record['primaryKey'] = $record[$this->primaryKey];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($record);
    }

    public function delete($field, $value)
    {
        $sql = "DELETE FROM $this->table WHERE $field = :value";
        $stmt = $this->pdo->prepare($sql);
        $record = ['value' => $value];
        $stmt->execute($record);
    }

    public function save($record)
    {
        $entity = new $this->className(...$this->constructorArgs);

        try {
//            if ($record[$this->primaryKey] == '') {
//                $record[$this->primaryKey] = null;
//            }
            $insertId = $this->insert($record);

            $entity->{$this->primaryKey} = $insertId;
        } catch (PDOException $e) {
            $this->update($record);
        }

        foreach ($record as $key => $value) {
            if (!empty($value)) {
                $entity->$key = $value;
            }
        }

        return $entity;
    }

    public function count($field, $value)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $this->table WHERE $field = :value");
        $record = ['value' => $value];
        $stmt->execute($record);
        $count = $stmt->fetch();

        return $count[0];
    }
}

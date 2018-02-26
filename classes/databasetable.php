<?php

namespace Classes;
use Exception;

class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct($pdo, $table, $primaryKey)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function find($field, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $field = :value";

        $stmt = $this->pdo->prepare($sql);

        $record = ['value' => $value];

        $stmt->execute($record);
        $row = $stmt->fetchAll();

        return $row;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM $this->table";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    public function insert($record)
    {
        $keys = array_keys($record);

        $fields = implode(', ', $keys);
        $values = implode(', :', $keys);
        $sql = "INSERT INTO $this->table ($fields) VALUES (:$values)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($record);
    }

    public function update($record)
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
        try {
            $this->insert($record);
        } catch (Exception $e) {
            $this->update($record);
        }
    }

    public function count($field, $value)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $this->table WHERE $field = :value");
        $record = [
            'value' => $value
        ];
        $stmt->execute($record);
        $count = $stmt->fetch();

        return $count[0];
    }
}

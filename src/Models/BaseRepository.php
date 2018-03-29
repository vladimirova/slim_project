<?php

namespace Application\Models;


abstract class BaseRepository
{
    public $db;

    protected $entityClass;

    /**
     * @var Mixed (Latitude\QueryBuilder\...)
     */
    public $query = '';

    /**
     * @var String
     */
    protected $table = '';

    /**
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * @var Array
     */
    protected $hidden = [];

    /**
     * @var Array
     */
    protected $result = [];

    public function __construct(\PDO $db)
    {
        if (!property_exists($this, 'table') || empty($this->table)) {
            throw new \Exception('Missing required table property', 500);
        }

        if (!property_exists($this, 'primaryKey') || empty($this->primaryKey)) {
            throw new \Exception('Missing required primaryKey property', 500);
        }

        $this->db = $db;
    }

    public function all($arguments = [])
    {
        $this->query = 'SELECT * FROM '. $this->table;

        return $this->run()->fetchAll(\PDO::FETCH_CLASS, $this->entityClass);
    }

    public function findByPrimaryKey($primaryKeyValue)
    {
        $this->query = 'SELECT * FROM '. $this->table. ' WHERE '. $this->primaryKey. ' = :primaryKey';

        return $this->run(['primaryKey' => $primaryKeyValue])->fetchObject($this->entityClass);
    }

    public function insert(BaseEntity $entity)
    {
        $attributes = $entity->attributes();
        unset($attributes[$this->primaryKey]);
        $attributesKeys = array_keys($attributes);

        $this->query = 'INSERT INTO '. $this->table. ' ('. implode(', ', $attributesKeys). ') values (:'. implode(', :', $attributesKeys).')';

        return $this->run($attributes);
    }

    public function update(BaseEntity $entity)
    {
        $attributes = $entity->attributes();

        $id = $attributes[$this->primaryKey];
        unset($attributes[$this->primaryKey]);

        $attributesKeys = array_keys($attributes);
        $last = end($attributesKeys);

        $this->query = 'UPDATE ' . $this->table. ' SET ';

        foreach ($attributesKeys as $attributesKey)
        {
            $this->query .= $attributesKey. ' = :'.$attributesKey;
            $this->query .= $attributesKey == $last ? ' ' : ' , ';
        }

        $this->query .= 'WHERE '.$this->primaryKey.' = :'.$this->primaryKey;

        $attributes[$this->primaryKey] = $id;

        return $this->run($attributes);
    }
//
//    public function delete(BaseEntity $entity)
//    {
//        $this->query = 'DELETE FROM '. $this->table. ' where '. $this->primaryKey. ' = '. $value;
//        return $this->run();
//    }

    public function run($params = [])
    {
        $statement = $this->db->prepare($this->query);

        $statement->execute($params);

        return $statement;
    }
}

<?php

namespace App\Repository;

use App\Services\Database\DatabaseConnection;

abstract class AbstractRepository implements RepositoryInterface {

    /**
     * Database table name
     *
     * @var string
     */
    protected $tableName = '';

    /**
     * @var \App\Services\Database\DatabaseConnection
     */
    protected $connection;

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $this->connection  = ( new DatabaseConnection() )->connection;
    }

    /**
     * Find all
     *
     * @return mixed
     */
    public function findAll()
    {
        $sql = 'SELECT * from  ' . $this->tableName;
        $query = $this->connection->prepare($sql);
        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results)) {
            return false;
        }

        $modelCollection = $this->translateResultsToModels($results);

        return $modelCollection;
    }

    /**
     * Find a row with a certain Id
     *
     * @param $id
     * @return bool
     */
    public function findById($id)
    {
        $sql = 'SELECT * from  ' . $this->tableName . ' where id = :id';
        $query = $this->connection->prepare($sql);
        $query->bindParam(':id', (int) $id, \PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch();

        if (empty($result)) {
            return false;
        }

        return $this->translateSingleResultToModel($result);
    }

    /**
     * Check if an Id exists in the DB already
     *
     * @param $id
     * @return bool
     */
    public function idExists($id)
    {
        $sql = 'SELECT * from ' . $this->tableName . ' where id = :id';

        $query = $this->connection->prepare($sql);
        $query->bindParam(':id', (int) $id, \PDO::PARAM_INT);

        $query->execute();

        $results = $query->fetchAll();

        if (empty($results)) {
            return false;
        }

        return true;
    }

    /**
     * Delete a record via ID
     *
     * @param $id
     * @return mixed
     */
    public function deleteById($id)
    {
        $sql = "DELETE FROM " . $this->tableName . " WHERE `id` = :id";
        $query = $this->connection->prepare($sql);

        $query->bindParam(':id', (int) $id, \PDO::PARAM_INT);

        $outcome = $query->execute();

        return $outcome;
    }

    /**
     * Translates a bunch of DB row results to an array of appropriate models
     *
     * @param array $results
     * @return array
     */
    protected function translateResultsToModels(array $results)
    {
        $modelCollection = [];

        foreach ($results as $result)
        {
            $modelCollection[] = $this->translateSingleResultToModel($result);
        }

        return $modelCollection;
    }

    /**
     * Translates a single result to a model
     *
     * @param array $result
     */
    protected function translateSingleResultToModel(array $result)
    {
        return $this->createModel($result);
    }

}
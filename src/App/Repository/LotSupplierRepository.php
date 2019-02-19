<?php

namespace App\Repository;

use App\Model\LotSupplier;

class LotSupplierRepository extends AbstractRepository
{

    protected $databaseBindings = [
      'lot_id'      => ':lot_id',
      'supplier_id' => ':supplier_id',
    ];

    /**
     * Database table name
     *
     * @var string
     */
    protected $tableName = 'ccs_lot_supplier';

    public function createModel($data = null)
    {
        return new LotSupplier($data);
    }

    /**
     * @param \App\Model\LotSupplier $lotSupplier
     * @return mixed
     */
    public function create(LotSupplier $lotSupplier)
    {
        // Build the bindings PDO statement
        $columns = implode(", ", array_keys($this->databaseBindings));
        $fieldParams = implode(", ", array_values($this->databaseBindings));

        $sql = 'INSERT INTO ' . $this->tableName . ' (' . $columns . ') VALUES(' . $fieldParams . ')';

        $query = $this->connection->prepare($sql);

        $query = $this->bindValues($this->databaseBindings, $query, $lotSupplier);

        return $query->execute();
    }

    /**
     * @param $searchField
     * @param $searchValue
     * @param \App\Model\LotSupplier $lotSupplier
     * @return mixed
     */
    public function update($searchField, $searchValue, LotSupplier $lotSupplier)
    {
        // Remove the field which we're using for the update command
        if (isset($this->databaseBindings[$searchField])) {
            unset($this->databaseBindings[$searchField]);
        }

        // Build the bindings PDO statement
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $count = 0;
        foreach ($this->databaseBindings as $column => $field) {
            $sql .= '`' . $column . '` = ' . $field;
            if (count($this->databaseBindings) != ($count + 1)) {
                $sql .= ', ';
            } else {
                $sql .= ' ';
            }
            $count++;
        }

        $sql .= 'WHERE ' . $searchField . ' = :searchValue';
        $query = $this->connection->prepare($sql);
        $query->bindParam(':searchValue', $searchValue, \PDO::PARAM_STR);

        $query = $this->bindValues($this->databaseBindings, $query, $lotSupplier);

        return $query->execute();
    }


    /**
     * Bind PDO Values
     *
     * @param $databaseBindings
     * @param $query
     * @param LotSupplier $lotSupplier
     * @return mixed
     */
    protected function bindValues($databaseBindings, $query, LotSupplier $lotSupplier)
    {
        if (isset($databaseBindings['lot_id'])) {
            $lotId = $lotSupplier->getLotId();
            $query->bindParam(':lot_id', $lotId, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['supplier_id'])) {
            $supplierId = $lotSupplier->getSupplierId();
            $query->bindParam(':supplier_id', $supplierId, \PDO::PARAM_STR);
        }

        return $query;
    }


}
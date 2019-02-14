<?php

namespace App\Repository;

use App\Model\Supplier;

class SupplierRepository extends AbstractRepository
{

    /**
     * Database table name
     *
     * @var string
     */
    protected $tableName = 'ccs_suppliers';

    public function createModel($data = null)
    {
        return new Supplier($data);
    }

    /**
     * @param \App\Model\Supplier $supplier
     * @return mixed
     */
    public function create(Supplier $supplier) {

        $databaseBindings = [
          'salesforce_id' => ':salesforce_id',
          'duns_number'   => ':duns_number',
          'name'          => ':name',
          'phone_number'  => ':phone_number',
          'address'       => ':address',
          'city'          => ':city',
          'country'       => ':country',
          'postcode'      => ':postcode',
          'website'       => ':website',
          'trading_name'  => ':trading_name',
        ];

        // Build the bindings PDO statement
        $columns = implode(", ", array_keys($databaseBindings));
        $fieldParams = implode(", ", array_values($databaseBindings));

        $sql = 'INSERT INTO ' . $this->tableName . ' (' . $columns . ') VALUES(' . $fieldParams . ')';

        $query = $this->connection->prepare($sql);

        $query = $this->bindValues($databaseBindings, $query, $supplier);

        return $query->execute();
    }

    /**
     * @param $searchField
     * @param $searchValue
     * @param \App\Model\Supplier $supplier
     * @return mixed
     */
    public function update($searchField, $searchValue, Supplier $supplier)
    {
         $databaseBindings = [
          'salesforce_id' => ':salesforce_id',
          'duns_number'   => ':duns_number',
          'name'          => ':name',
          'phone_number'  => ':phone_number',
          'address'       => ':address',
          'city'          => ':city',
          'country'       => ':country',
          'postcode'      => ':postcode',
          'website'       => ':website',
          'trading_name'  => ':trading_name',
        ];

        // Remove the field which we're using for the update command
        if (isset($databaseBindings[$searchField]))
        {
            unset($databaseBindings[$searchField]);
        }

        // Build the bindings PDO statement
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $count = 0;
        foreach ($databaseBindings as $column => $field) {
            $sql .= '`' . $column . '` = ' . $field;
            if (count($databaseBindings) != ($count + 1)) {
                $sql .= ', ';
            } else {
                $sql .= ' ';
            }
            $count++;
        }

        $sql .= 'WHERE ' . $searchField . ' = :searchValue';
        $query = $this->connection->prepare($sql);
        $query->bindParam(':searchValue', $searchValue, \PDO::PARAM_STR);

        $query = $this->bindValues($databaseBindings, $query, $supplier);

        return $query->execute();
    }


    /**
     * Bind PDO Values
     *
     * @param $databaseBindings
     * @param $query
     * @param $supplier
     * @return mixed
     */
    protected function bindValues($databaseBindings, $query, Supplier $supplier)
    {
        if (isset($databaseBindings['salesforce_id']))
        {
            $salesforceId = $supplier->getSalesforceId();
            $query->bindParam(':salesforce_id', $salesforceId, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['duns_number']))
        {
            $dunsNumber = $supplier->getDunsNumber();
            $query->bindParam(':duns_number', $dunsNumber, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['name']))
        {
            $name = $supplier->getName();
            $query->bindParam(':name', $name, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['phone_number']))
        {
            $phoneNumber = $supplier->getStatus();
            $query->bindParam(':phone_number', $phoneNumber, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['address']))
        {
            $address = $supplier->getStatus();
            $query->bindParam(':address', $address, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['city']))
        {
            $city = $supplier->getStatus();
            $query->bindParam(':city', $city, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['country']))
        {
            $country = $supplier->getStatus();
            $query->bindParam(':country', $country, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['postcode']))
        {
            $postcode = $supplier->getStatus();
            $query->bindParam(':postcode', $postcode, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['website']))
        {
            $website = $supplier->getStatus();
            $query->bindParam(':website', $website, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['trading_name']))
        {
            $tradingName = $supplier->getStatus();
            $query->bindParam(':trading_name', $tradingName, \PDO::PARAM_STR);
        }

        return $query;
    }


}
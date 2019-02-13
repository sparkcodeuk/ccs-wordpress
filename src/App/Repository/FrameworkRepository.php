<?php

namespace App\Repository;

use App\Model\Framework;

class FrameworkRepository extends AbstractRepository {

     /**
     * Database table name
     *
     * @var string
     */
    protected $tableName = 'ccs_frameworks';

    public function createModel($data = null)
    {
        return new Framework($data);
    }

    /**
     * @param \App\Model\Framework $framework
     * @return mixed
     */
    public function create(Framework $framework) {

        $databaseBindings = [
          'title'               => ':title',
          'rm_number'           => ':rm_number',
          'wordpress_id'        => ':wordpress_id',
          'salesforce_id'       => ':salesforce_id',
          'start_date'          => ':start_date',
          'end_date'            => ':end_date',
          'tenders_open_date'   => ':tenders_open_date',
          'tenders_close_date'  => ':tenders_close_date',
          'expected_live_date'  => ':expected_live_date',
          'expected_award_date' => ':expected_award_date',
        ];

        // Build the bindings PDO statement
        $columns = implode(", ", array_keys($databaseBindings));
        $fieldParams = implode(", ", array_values($databaseBindings));

        $sql = 'INSERT INTO ' . $this->tableName . ' (' . $columns . ') VALUES(' . $fieldParams . ')';

        $query = $this->connection->prepare($sql);

        $query = $this->bindValues($databaseBindings, $query, $framework);

        return $query->execute();
    }

    /**
     * @param $searchField
     * @param $searchValue
     * @param \App\Model\Framework $framework
     * @return mixed
     */
    public function update($searchField, $searchValue, Framework $framework)
    {
        $databaseBindings = [
          'title'               => ':title',
          'rm_number'           => ':rm_number',
          'wordpress_id'        => ':wordpress_id',
          'salesforce_id'       => ':salesforce_id',
          'start_date'          => ':start_date',
          'end_date'            => ':end_date',
          'tenders_open_date'   => ':tenders_open_date',
          'tenders_close_date'  => ':tenders_close_date',
          'expected_live_date'  => ':expected_live_date',
          'expected_award_date' => ':expected_award_date',
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

        $query = $this->bindValues($databaseBindings, $query, $framework);

        return $query->execute();
    }


    /**
     * Bind PDO Values
     *
     * @param $databaseBindings
     * @param $query
     * @param $framework
     * @return mixed
     */
    protected function bindValues($databaseBindings, $query, Framework $framework)
    {
        // Bind values todo: Simplfy this process

        if (isset($databaseBindings['rm_number']))
        {
            $rmNumber = $framework->getRmNumber();
            $query->bindParam(':rm_number', $rmNumber, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['title']))
        {
            $title = $framework->getTitle();
            $query->bindParam(':title', $title, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['wordpress_id']))
        {
            $wordpressId = $framework->getWordpressId();
            $query->bindParam(':wordpress_id', $wordpressId, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['salesforce_id']))
        {
            $salesforceId = $framework->getSalesforceId();
            $query->bindParam(':salesforce_id', $salesforceId, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['start_date']))
        {
            $startDate = $framework->getStartDate();
            if ($startDate instanceof \DateTime)
            {
                $startDate = $startDate->format('Y-m-d');
            }
            $query->bindParam(':start_date', $startDate, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['end_date']))
        {
            $endDate = $framework->getEndDate();
            if ($endDate instanceof \DateTime)
            {
                $endDate = $endDate->format('Y-m-d');
            }
            $query->bindParam(':end_date', $endDate, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['tenders_open_date']))
        {
            $tendersOpenDate = $framework->getTendersOpenDate();
            if ($tendersOpenDate instanceof \DateTime)
            {
                $tendersOpenDate = $tendersOpenDate->format('Y-m-d');
            }
            $query->bindParam(':tenders_open_date', $tendersOpenDate, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['tenders_close_date']))
        {
            $tendersCloseDate = $framework->getTendersCloseDate();
            if ($tendersCloseDate instanceof \DateTime)
            {
                $tendersCloseDate = $tendersCloseDate->format('Y-m-d');
            }
            $query->bindParam(':tenders_close_date', $tendersCloseDate, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['expected_live_date']))
        {
            $expectedLiveDate = $framework->getExpectedLiveDate();
            if ($expectedLiveDate instanceof \DateTime)
            {
                $expectedLiveDate = $expectedLiveDate->format('Y-m-d');
            }
            $query->bindParam(':expected_live_date', $expectedLiveDate, \PDO::PARAM_STR);
        }

        if (isset($databaseBindings['expected_award_date']))
        {
            $expectedAwardDate = $framework->getExpectedAwardDate();
            if ($expectedAwardDate instanceof \DateTime)
            {
                $expectedAwardDate = $expectedAwardDate->format('Y-m-d');
            }
            $query->bindParam(':expected_award_date', $expectedAwardDate, \PDO::PARAM_STR);
        }

        return $query;
    }

}
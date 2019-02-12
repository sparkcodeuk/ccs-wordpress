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

}
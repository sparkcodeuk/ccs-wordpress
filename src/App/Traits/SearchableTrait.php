<?php

namespace App\Traits;

trait SearchableTrait {

    /**
     * You can add the below array of properties to your class which will be excluded from the search index
     *
     * @var array
     */
    // protected $excludeFromSearch = [];

    /**
     * Indexes the current model
     */
    public function reindex()
    {

    }

}
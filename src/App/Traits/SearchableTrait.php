<?php

namespace App\Traits;

trait SearchableTrait {

    /**
     * An array of properties to be excluded from the search index
     *
     * @var array
     */
    protected $excludeFromSearch = [];

    /**
     * Indexes the current model
     */
    public function reindex()
    {

    }

}
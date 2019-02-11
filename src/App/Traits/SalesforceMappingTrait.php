<?php

namespace App\Traits;

trait SalesforceMappingTrait {

    /**
     * An array of mappings for model properties to salesforce properties
     * Key is model
     * Value is salesforce
     *
     * @var array
     */
    protected $mappings = [];

    /**
     * Load the YAML config file and convert it to a mappings array
     */
    protected function loadMappings()
    {
        // Load a YAML config file with the mappings

        $this->mappings = 'The config just loaded';
    }

}
<?php

namespace App\Traits;

use App\Utils\YamlLoader;
use Symfony\Component\Yaml\Yaml;

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
     * @param $data
     * @throws \ReflectionException
     */
    public function setMappedFields($data)
    {
        
        $className = (new \ReflectionClass($this))->getShortName();
        
        if (empty($this->mappings)) {
            $this->mappings = YamlLoader::loadMappings($className);
        }

        foreach ($this->mappings['properties'] as $classProperty => $salesforceProperty)
        {
            $method = "set" . ucfirst($classProperty);
            $this->$method($data->$salesforceProperty);
        }
    }

}
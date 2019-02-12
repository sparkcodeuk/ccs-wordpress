<?php

namespace App\Traits;

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
            $this->loadMappings($className);
        }

        foreach ($this->mappings['properties'] as $classProperty => $salesforceProperty)
        {
            $method = "set" . ucfirst($classProperty);
            $this->$method($data->$salesforceProperty);
        }

        print_r($this);
        die();

        // todo: Load the mapped fields
    }

    /**
     * Load the YAML config file and convert it to a mappings array
     * @param string $fileName
     * @return mixed
     */
    protected function loadMappings(string $fileName): void
    {
        $this->mappings = Yaml::parseFile(__DIR__ . '/../Config/Mappings/' . $fileName . '.yaml');
    }

}
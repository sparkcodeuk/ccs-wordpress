<?php

namespace App\Model;

use App\Traits\SalesforceMappingTrait;
use App\Traits\SearchableTrait;
use Nayjest\StrCaseConverter\Str;

class Supplier implements ModelInterface {

    use SearchableTrait, SalesforceMappingTrait;

    protected $excludeFromSearch = [];

    /**
     * Lot constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if (empty($data)) {
            return;
        }

        foreach ($data as $key => $value)
        {
            $this->{'set' . Str::toCamelCase($key)}($value);
        }
    }

    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $salesforceId;
    /**
     * @var string
     */
    protected $dunsNumber;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $phoneNumber;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var string
     */
    protected $city;
    /**
     * @var string
     */
    protected $country;
    /**
     * @var string
     */
    protected $postcode;
    /**
     * @var string
     */
    protected $website;
    /**
     * @var string
     */
    protected $tradingName;


    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Lot
     */
    public function setId(?string $id): Lot
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalesforceId(): ?string
    {
        return $this->salesforceId;
    }

    /**
     * @param string $salesforceId
     * @return Lot
     */
    public function setSalesforceId(?string $salesforceId): Lot
    {
        $this->salesforceId = $salesforceId;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDunsNumber(): ?string
    {
        return $this->dunsNumber;
    }

    /**
     * @param string $dunsNumber
     * @return Supplier
     */
    public function setDunsNumber(?string $dunsNumber): Supplier
    {
        $this->dunsNumber = $dunsNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Supplier
     */
    public function setName(?string $name): Supplier
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return Supplier
     */
    public function setPhoneNumber(?string $phoneNumber): Supplier
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Supplier
     */
    public function setAddress(?string $address): Supplier
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Supplier
     */
    public function setCity(?string $city): Supplier
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Supplier
     */
    public function setCountry(?string $country): Supplier
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     * @return Supplier
     */
    public function setPostcode(?string $postcode): Supplier
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return Supplier
     */
    public function setWebsite(?string $website): Supplier
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradingName(): ?string
    {
        return $this->tradingName;
    }

    /**
     * @param string $tradingName
     * @return Supplier
     */
    public function setTradingName(?string $tradingName): Supplier
    {
        $this->tradingName = $tradingName;
        return $this;
    }

    

}
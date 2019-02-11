<?php

namespace App\Model;

use App\Traits\SalesforceMappingTrait;
use App\Traits\SearchableTrait;

class Framework extends AbstractModel {

    use SearchableTrait, SalesforceMappingTrait;

    protected $excludeFromSearch = ['documents', 'documentUpdates'];

    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $summary;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $updates;
    /**
     * @var string
     */
    protected $benefits;
    /**
     * @var array
     */
    protected $lots;
    /**
     * @var string
     */
    protected $howToBuy;
    /**
     * @var string
     */
    protected $terms;
    /**
     * @var string
     */
    protected $pillar;
    /**
     * @var string
     */
    protected $category;
    /**
     * @var string
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $startDate;
    /**
     * @var \DateTime
     */
    protected $endDate;
    /**
     * @var \DateTime
     */
    protected $tendersOpenDate;
    /**
     * @var \DateTime
     */
    protected $tendersCloseDate;
    /**
     * @var \DateTime
     */
    protected $expectedLiveDate;
    /**
     * @var \DateTime
     */
    protected $expectedAwardDate;
    /**
     * @var string
     */
    protected $documentUpdates;
    /**
     * @var array
     */
    protected $documents;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Framework
     */
    public function setId(int $id): Framework
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Framework
     */
    public function setTitle(string $title): Framework
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return Framework
     */
    public function setSummary(string $summary): Framework
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Framework
     */
    public function setDescription(string $description): Framework
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdates(): string
    {
        return $this->updates;
    }

    /**
     * @param string $updates
     * @return Framework
     */
    public function setUpdates(string $updates): Framework
    {
        $this->updates = $updates;
        return $this;
    }

    /**
     * @return string
     */
    public function getBenefits(): string
    {
        return $this->benefits;
    }

    /**
     * @param string $benefits
     * @return Framework
     */
    public function setBenefits(string $benefits): Framework
    {
        $this->benefits = $benefits;
        return $this;
    }

    /**
     * @return array
     */
    public function getLots(): array
    {
        return $this->lots;
    }

    /**
     * @param array $lots
     * @return Framework
     */
    public function setLots(array $lots): Framework
    {
        $this->lots = $lots;
        return $this;
    }

    /**
     * @return string
     */
    public function getHowToBuy(): string
    {
        return $this->howToBuy;
    }

    /**
     * @param string $howToBuy
     * @return Framework
     */
    public function setHowToBuy(string $howToBuy): Framework
    {
        $this->howToBuy = $howToBuy;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerms(): string
    {
        return $this->terms;
    }

    /**
     * @param string $terms
     * @return Framework
     */
    public function setTerms(string $terms): Framework
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return string
     */
    public function getPillar(): string
    {
        return $this->pillar;
    }

    /**
     * @param string $pillar
     * @return Framework
     */
    public function setPillar(string $pillar): Framework
    {
        $this->pillar = $pillar;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Framework
     */
    public function setCategory(string $category): Framework
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Framework
     */
    public function setStatus(string $status): Framework
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return Framework
     */
    public function setStartDate(\DateTime $startDate): Framework
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return Framework
     */
    public function setEndDate(\DateTime $endDate): Framework
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTendersOpenDate(): \DateTime
    {
        return $this->tendersOpenDate;
    }

    /**
     * @param \DateTime $tendersOpenDate
     * @return Framework
     */
    public function setTendersOpenDate(\DateTime $tendersOpenDate): Framework
    {
        $this->tendersOpenDate = $tendersOpenDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTendersCloseDate(): \DateTime
    {
        return $this->tendersCloseDate;
    }

    /**
     * @param \DateTime $tendersCloseDate
     * @return Framework
     */
    public function setTendersCloseDate(\DateTime $tendersCloseDate): Framework
    {
        $this->tendersCloseDate = $tendersCloseDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpectedLiveDate(): \DateTime
    {
        return $this->expectedLiveDate;
    }

    /**
     * @param \DateTime $expectedLiveDate
     * @return Framework
     */
    public function setExpectedLiveDate(\DateTime $expectedLiveDate): Framework
    {
        $this->expectedLiveDate = $expectedLiveDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpectedAwardDate(): \DateTime
    {
        return $this->expectedAwardDate;
    }

    /**
     * @param \DateTime $expectedAwardDate
     * @return Framework
     */
    public function setExpectedAwardDate(\DateTime $expectedAwardDate
    ): Framework {
        $this->expectedAwardDate = $expectedAwardDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentUpdates(): string
    {
        return $this->documentUpdates;
    }

    /**
     * @param string $documentUpdates
     * @return Framework
     */
    public function setDocumentUpdates(string $documentUpdates): Framework
    {
        $this->documentUpdates = $documentUpdates;
        return $this;
    }

    /**
     * @return array
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @param array $documents
     * @return Framework
     */
    public function setDocuments(array $documents): Framework
    {
        $this->documents = $documents;
        return $this;
    }

}
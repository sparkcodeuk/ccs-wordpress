<?php

namespace App\Model;

use App\Traits\SalesforceMappingTrait;
use App\Traits\SearchableTrait;
use Nayjest\StrCaseConverter\Str;

class LotSupplier extends AbstractModel {

    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $lotId;
    /**
     * @var string
     */
    protected $supplierId;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return LotSupplier
     */
    public function setId(string $id): LotSupplier
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLotId(): ?string
    {
        return $this->lotId;
    }

    /**
     * @param string $lotId
     * @return LotSupplier
     */
    public function setLotId(string $lotId): LotSupplier
    {
        $this->lotId = $lotId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierId(): ?string
    {
        return $this->supplierId;
    }

    /**
     * @param string $supplierId
     * @return LotSupplier
     */
    public function setSupplierId(string $supplierId): LotSupplier
    {
        $this->supplierId = $supplierId;
        return $this;
    }

}
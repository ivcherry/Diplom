<?php

namespace App\Entities;

class ProductsFilter {
    private $typeId;
    private $productName;
    private $orderByPrice;

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getOrderByPrice()
    {
        return $this->orderByPrice;
    }

    /**
     * @param mixed $orderByPrice
     */
    public function setOrderByPrice($orderByPrice)
    {
        $this->orderByPrice = $orderByPrice;
    }


}
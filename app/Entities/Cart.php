<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

class Cart{
    private $productsInfo;
    private $productsCount;
    private $totalSum;

    public function __construct()
    {
        $this->productsInfo = new ArrayCollection();
        $this->productsCount = 0;
        $this->totalSum = 0;
    }

    public function addProduct($productInfo){
        if(!$this->productsInfo->isEmpty()){
            $isExists = $this->productsInfo->exists(function ($key, $element) use($productInfo){
                return  $element->productId === $productInfo->productId;
            });
            if(!$isExists){
                $this->productsInfo->add($productInfo);
                $this->productsCount++;
            }
        }
        else{
            $this->productsInfo->add($productInfo);
            $this->productsCount++;
        }
    }

    public function getProductsInfo(){
        return $this->productsInfo;
    }

    public function getProductsIds()
    {
        $prodIds = new ArrayCollection();

        if(!$this->productsInfo->isEmpty()){
           foreach ($this->productsInfo as $productInfo){
               $prodIds->add($productInfo->productId);
           }
        }
        return $prodIds->toArray();
    }

    public function getProductsCount()
    {
        return $this->productsCount;
    }

    public function deleteProduct($productId){
        if(!$this->productsInfo->isEmpty()){
            $removableProductsInfo = $this->productsInfo->filter(function ($element) use($productId){
                return  $element->productId === $productId;
            });
            if(!$removableProductsInfo->isEmpty()){
                $this->productsInfo->removeElement($removableProductsInfo->first());
                $this->productsCount--;
            }
        }
    }

    public function updateProductInfo($productInfo){
        if(!$this->productsInfo->isEmpty()){
            $editableProductsInfo = $this->productsInfo->filter(function ($element) use($productInfo){
                return  $element->productId === $productInfo->productId;
            });
            if(!$editableProductsInfo->isEmpty()){
                $this->productsInfo->removeElement($editableProductsInfo->first());
                $this->productsInfo->add($productInfo);
            }
        }
    }
}
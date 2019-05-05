<?php
namespace App\Entities;

class ProductInfo {
    public $productId;
    public $productAmount;

    public function setProductInfo($id, $amount){
        $this->productId = $id;
        $this->productAmount = $amount;
    }
}
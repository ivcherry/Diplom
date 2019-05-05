<?php

namespace App\Entities;

class CompareProducts
{

    public $prodIds = null;
    public $comparedCount;

    public function __construct($oldCompare) {
        if ($oldCompare) {
            $this->prodIds = $oldCompare->prodIds;
            $this->comparedCount = $oldCompare->comparedCount;
        } else {
           $this->prodIds = array();
           $this->comparedCount = 0;
        }
    }

    public function add($id) {
        if (!(in_array($id, $this->prodIds))) {
          array_push($this->prodIds, $id);
          $this->comparedCount++;
        }
    }

    public function getProdIds() {
        return $this->prodIds;
    }

    public function getComparedCount()
    {
        return $this->comparedCount;
    }

    public function deleteProduct($prodId){
        $deletedProdId = array_search($prodId, $this->prodIds);

        if(isset($deletedProdId)){
            unset($this->prodIds[$deletedProdId]);
            $this->comparedCount--;
        }
    }

}

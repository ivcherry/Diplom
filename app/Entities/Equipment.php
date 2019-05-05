<?php

namespace App\Entities;

class Equipment{
    public $equipmentStages;
    public $currentStage;
    private $firstStage = 'processor';
    private $finalStage = 'final';

    public function __construct()
    {
        $this->equipmentStages = array(
            'processor' => 'unknown',
            'motherboard' => 'unknown',
            'videoCard' => 'unknown',
            'cooler' => 'unknown',
            'SSD' => 'unknown',
            'powerSupply' => 'unknown',
            'computerCase' => 'unknown'
        );
        $currentStage = null;
    }

    public function getCurrentStage()
    {
        return $this->currentStage;
    }

    public function setCurrentStage($currentStage)
    {
        $this->currentStage = $currentStage;
    }

    public function isFirstStage($stage){
        return $stage == $this->firstStage;
    }

    public function setProductIdByStage($stage,$productId){
        $this->equipmentStages[$stage] = $productId;
    }

    public function checkCurrentStage($stage){
        return $stage == $this->currentStage;
    }

    public function checkAllStages(){
        foreach($this->equipmentStages as $stage){
            if($stage == 'unknown'){
                return false;
            }
        }

        return true;
    }

    public function getProductsIds(){
        return $this->equipmentStages;
    }

    public function getProductIdByStage($stage){
        if(key_exists($stage, $this->equipmentStages)){
            return $this->equipmentStages[$stage];
        }
        return null;
    }

}
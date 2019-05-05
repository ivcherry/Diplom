<?php

namespace App\Helpers;


class EquipmentHelper{

    public function getFirstStage(){
        return 'processor';
    }

    public function getTypeNameByStage($stage){
        switch ($stage){
            case 'processor': return 'Процессоры';
            case 'motherboard': return 'Материнские платы';
            case 'videoCard': return 'Видеокарты';
            case 'cooler' : return 'Кулеры';
            case 'SSD' : return 'SSD';
            case 'powerSupply' : return 'Блоки питания';
            case 'computerCase' : return 'Корпуса';
        }
    }

    public function getEquipmentViewName($stage){
        switch ($stage){
            case 'processor': return 'Выберите процессор';
            case 'motherboard': return 'Выберите материнскую плату';
            case 'videoCard': return 'Выберите видеокарту';
            case 'cooler' : return 'Выберите кулер';
            case 'SSD' : return 'Выберите SSD';
            case 'powerSupply' : return 'Выберите блок питания';
            case 'computerCase' : return 'Выберите корпус';
        }
        return "";
    }

    public function getNextEquipmentStage($stage){
        switch ($stage){
            case 'processor': return 'motherboard';
            case 'motherboard': return 'videoCard';
            case 'videoCard': return 'cooler';
            case 'cooler' : return 'SSD';
            case 'SSD' : return 'powerSupply';
            case 'powerSupply' : return 'computerCase';
            case 'computerCase' : return 'final';
        }
        return "";
    }

    public function getFinalStage(){
        return 'final';
    }

    public function getPreviousEquipmentStage($stage){
        switch ($stage){
            case 'processor': return 'motherboard';
            case 'motherboard': return 'processor';
            case 'videoCard': return 'motherboard';
            case 'cooler' : return 'videoCard';
            case 'SSD' : return 'cooler';
            case 'powerSupply' : return 'SSD';
            case 'computerCase' : return 'powerSupply';
            case 'final' : return 'computerCase';
        }

        return "";
    }
}
<?php

namespace App\BusinessLogic;

use App\Entities\Feature;
use App\Entities\Type;
use App\Repositories\UnitOfWork\UnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

class FeatureManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAllFeatures()
    {
        return $this->_unitOfWork->featureRepository()->all();
    }

    public function getFeatureById($id)
    {
        return $this->_unitOfWork->featureRepository()->get($id);
    }

    public function getFeatureByName($name)
    {
        if (!empty($name))
        {
            return $this->_unitOfWork->featureRepository()->where("features.name like %$name%");
        }
    }

    public function addFeature(Feature $feature)
    {

      if (empty($feature->getName()))
      {
          throw new Exception("Невозможно добавить характеристику с пустым наименованием");
      }
      $this->_unitOfWork->featureRepository()->create($feature);
      $this->_unitOfWork->commit();

    }


    public function deleteFeature($id){
        if(empty($id)){
          throw new Exception("Невозможно удалить. Отсуствует идентификатор.");
        }

        $feature = $this->_unitOfWork->featureRepository()->get($id);
        if(!isset($feature)){
          throw new Exception("Невозможно удалить. Идентификатор $id не найден.");
        }
        $this->_unitOfWork->featureRepository()->delete($feature);
        $this->_unitOfWork->commit();
    }

    public function editFeature(Feature $newFeature){
        if(empty($newFeature->getId())){
          throw new Exception("Невозможно изменить. Не указан идентификатор");
        }

        if(empty($newFeature->getName())){
          throw new Exception("Невозможно изменить. Не указано наименование");
        }
        $this->_unitOfWork->featureRepository()->update($newFeature);
        $this->_unitOfWork->commit();
    }

    public function getPaginetedFeatures($pageSize, $pageNumber){
        $features = new ArrayCollection();
        $paginatedFeatures = $this->_unitOfWork->featureRepository()->getPaginatedFeatures($pageSize, $pageNumber);
        foreach($paginatedFeatures->getData() as $feature)
        {
            $features->add($feature->jsonSerialize());
        }
        $paginatedFeatures->setData($features->toArray());
        return $paginatedFeatures;
    }

    public function getFeaturesByTypeId($typeId){
        $type = $this->_unitOfWork->typeRepository()->get($typeId);
        $features = $type->getFeatures();
        $features = $features->map(function($item){
           return $item->jsonSerialize();
        });

        return $features->toArray();
    }
}

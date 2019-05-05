<?php

namespace App\BusinessLogic;

use App\Entities\Compatibility;
use App\Entities\Type;
use App\Repositories\UnitOfWork\UnitOfWork;
use App\ViewModels\TypeViewModel;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Support\Arr;

class TypeManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function addType(TypeViewModel $model)
    {

        if(empty($model)){
            throw new Exception("Невозможно создать новую подкатегорию.");
        }
        if(empty($model->getName())){
            throw new Exception("Невозможно создать новую подкатегорию. Отсутствует название подкатегории.");
        }
        $type = new Type();
        $type->setName($model->getName());
        $genericType = $this->_unitOfWork->genericTypeRepository()->get($model->getGenericTypeId());
        if(!isset($genericType)){
            throw new Exception("Невозможно создать новую подкатегорию. Отсутствует категория товара с идентификатором".$model->getGenericTypeId());
        }

        $type->setGenericType($genericType);
        $this->_unitOfWork->typeRepository()->create($type);
        $this->_unitOfWork->commit();
    }

    public function getTypeByName($name)
    {
        return $this->_unitOfWork->typeRepository()->getTypeByName($name);
    }

    public function getAllTypes()
    {
        $types = array();
        foreach($this->_unitOfWork->typeRepository()->all() as $type)
        {
           array_push($types, $type->jsonSerialize());
        }

        return $types;
    }

    public function getAllEntityTypes(){
        return new ArrayCollection($this->_unitOfWork->typeRepository()->all());
    }

    public function getTypeById($id)
    {
        if(!empty($id))
        {
            $type = $this->_unitOfWork->typeRepository()->get($id);
            $typeModel = new TypeViewModel();
            $typeModel->fillFromType($type);

            return $typeModel;
        }
        else
        {
            throw new Exception("Невозможно найти подкатегорию товара.Отсутствует параметр id");
        }

    }

    public function editType(TypeViewModel $typeViewModel)
    {
        if (empty($typeViewModel->getId())) {
            throw new Exception("Невозможно найти подкатегорию товара.Отсутствует параметр id");
        }
        if (empty($typeViewModel->getName())) {
            throw new Exception("Невозможно изменить подкатегорию товара. Отсутствует наименвание товара.");
        }
        if(empty($typeViewModel->getGenericTypeId())){
            throw new Exception("Невозможно изменить подкатегорию товара. Отсутствует идентификатор категории товара.");
        }
        $type = $this->_unitOfWork->typeRepository()->get($typeViewModel->getId());
        if (!isset($type)) {
            throw new Exception("Подкатегория товара с id". $typeViewModel->getId()."не найден");
        }

        $type->setName($typeViewModel->getName());
        $genericType = $this->_unitOfWork->genericTypeRepository()->get($typeViewModel->getGenericTypeId());
        if(!isset($genericType)){
            throw new Exception("Невозможно изменить подкатегорию товара. Отсутствует категория товара с идентификатором".$typeViewModel->getGenericTypeId());
        }
        $type->setGenericType($genericType);
        $this->_unitOfWork->typeRepository()->update($type);
        $this->_unitOfWork->commit();
    }

    public function deleteType($id){
        if(empty($id)){
            throw new Exception("Невозможно удалить подкатегрия товара. Отсуствует идентификатор подкатегории товара.");
        }

        $type = $this->_unitOfWork->typeRepository()->get($id);
        if(!isset($type)){
            throw new Exception("Невозможно удалить подкатегорию товара. Подкатегория товара с идентификатором $id не найден.");
        }
        $this->_unitOfWork->typeRepository()->delete($type);
        $this->_unitOfWork->commit();
    }

    public function getPaginatedTypes($pageSize, $pageNumber){
        $types = new ArrayCollection();
        $paginatedTypes = $this->_unitOfWork->typeRepository()->getPaginatedTypes($pageSize, $pageNumber);
        foreach($paginatedTypes->getData() as $type)
        {
            $viewModel = new TypeViewModel();
            $viewModel->fillFromType($type);
            $viewModel->jsonSerialize();
            $types->add($viewModel);
        }
        $paginatedTypes->setData($types->toArray());
        return $paginatedTypes;
    }

    public function getTypeFeatures($typeId){
        if(empty($typeId)){
            throw new Exception("Невозможно найти характеристики подкатегории. Отсутствует идентификатор подкатегории");
        }
        $type = $this->_unitOfWork->typeRepository()->get($typeId);
        if(!isset($type)){
            throw new Exception("Невозможно найти характеристики подкатегории. Не найдена подкатегория товара с идентификатором".$typeId);
        }
        return $type;
  }

  public function addFeatureToType($typeId, $featureId){
      if (empty($typeId)) {
          throw new Exception("Невозможно добавить характеристику подкатегории. Отсутствует идентификатор подкатегории");
      }
      if (empty($featureId)) {
          throw new Exception("Невозможно добавить характеристику подкатегории. Отсутствует идентификатор характеристики");
      }

      $type = $this->_unitOfWork->typeRepository()->get($typeId);
      if(!isset($type)){
          throw new Exception("Невозможно добавить характеристику подкатегории. Не найдена подкатегория товара с идентификатором".$typeId);
      }

      $feature = $this->_unitOfWork->featureRepository()->get($featureId);
      if(!isset($feature)){
          throw new Exception("Невозможно добавить характеристику подкатегории. Не найдена характеристика товара с идентификатором".$featureId);
      }
      if($type->getFeatures()->contains($feature)){
          throw new Exception("Данная характеристика уже присутствует в подкатегории ".$type->getName());
      }

      $type->addFeature($feature);
      $feature->addType($type);
      $this->_unitOfWork->typeRepository()->update($type);
      $this->_unitOfWork->featureRepository()->update($feature);
      $this->_unitOfWork->commit();
  }

  public function deleteTypeFeature($typeId, $featureId){
      if (empty($typeId)) {
          throw new Exception("Невозможно удалить характеристику подкатегории. Отсутствует идентификатор подкатегории");
      }
      if (empty($featureId)) {
          throw new Exception("Невозможно удалить характеристику подкатегории. Отсутствует идентификатор характеристики");
      }

      $type = $this->_unitOfWork->typeRepository()->get($typeId);
      if(!isset($type)){
          throw new Exception("Невозможно удалить характеристику подкатегории. Не найдена подкатегория товара с идентификатором".$typeId);
      }

      $feature = $this->_unitOfWork->featureRepository()->get($featureId);
      if(!isset($feature)){
          throw new Exception("Невозможно удалить характеристику подкатегории. Не найдена характеристика товара с идентификатором".$featureId);
      }

      $type->deleteFeature($feature);
      $feature->deleteType($type);

      $this->_unitOfWork->typeRepository()->update($type);
      $this->_unitOfWork->featureRepository()->update($feature);

      $this->_unitOfWork->commit();
  }

    public function getTypeEntityById($id){
        return $this->_unitOfWork->typeRepository()->get($id);
    }

    public function getPaginatedCompatibilities($pageSize, $pageNumber){

        $paginatedResult = $this->_unitOfWork->compatibilityRepo()->getPaginated($pageSize, $pageNumber);

        $compatibilities = new ArrayCollection($paginatedResult->getData());

        $compatibilities = $compatibilities->map(function ($item){
            return $item->jsonSerialize();
        });
        $paginatedResult->setData($compatibilities->toArray());
        return $paginatedResult;
    }

    public function getCompatibilityById($id){
        if(empty($id)){
            throw new Exception("Невозможно получить совместимость. Отсутствует id");
        }
        $compatibility = $this->_unitOfWork->compatibilityRepo()->get($id);
        if(!isset($compatibility)){
            throw new Exception("Невозможно получить совместимость. Совместимость с идентификатором $id не найдена");
        }

        return $compatibility;
    }

    public function deleteCompatibilityById($id){
        if(empty($id)){
            throw new Exception("Невозможно удалить совместимость. Отсутствует id");
        }
        $compatibility = $this->_unitOfWork->compatibilityRepo()->get($id);
        if(!isset($compatibility)){
            throw new Exception("Невозможно удалить совместимость. Совместимость с идентификатором $id не найдена.");
        }
        $this->_unitOfWork->compatibilityRepo()->delete($compatibility);
        $this->_unitOfWork->commit();
    }

    public function addCompatibility($firstTypeId, $secondTypeId, $firstFeatureId, $secondFeatureId, $rule){
        if(empty($firstTypeId)){
            throw new Exception("Невозможно добавить совместимость. Отсутствует идентификатор первой подкатегории");
        }
        if(empty($secondTypeId)){
            throw new Exception("Невозможно добавить совместимость. Отсутствует идентификатор второй подкатегории");
        }
        if(empty($firstFeatureId)){
            throw new Exception("Невозможно добавить совместимость. Отсутствует идентификатор первой характеристики");
        }
        if(empty($secondFeatureId)){
            throw new Exception("Невозможно добавить совместимость. Отсутствует идентификатор второй характеристики");
        }
        if(empty($rule)){
            throw new Exception("Невозможно добавить совместимость. Отсутствует правило совместимости");
        }

        $firstType = $this->_unitOfWork->typeRepository()->get($firstTypeId);
        if(!isset($firstType)){
            throw new Exception("Невозможно добавить совместимость. Не найдена подкатегория с идентификатором".$firstTypeId);
        }

        $secondType = $this->_unitOfWork->typeRepository()->get($secondTypeId);
        if(!isset($secondType)){
            throw new Exception("Невозможно добавить совместимость. Не найдена подкатегория с идентификатором".$secondTypeId);
        }

        $firstFeature = $this->_unitOfWork->featureRepository()->get($firstFeatureId);
        if(!isset($firstFeature)){
            throw new Exception("Невозможно добавить совместимость. Не найдена характеристика с идентификатором".$firstFeatureId);
        }

        $secondFeature = $this->_unitOfWork->featureRepository()->get($secondFeatureId);
        if(!isset($secondFeature)){
            throw new Exception("Невозможно добавить совместимость. Не найдена характеристика с идентификатором".$secondFeatureId);
        }

        $compatibility = new Compatibility();
        $compatibility->setFirstType($firstType);
        $compatibility->setFirstFeature($firstFeature);
        $compatibility->setSecondType($secondType);
        $compatibility->setSecondFeature($secondFeature);
        $compatibility->setRule($rule);

        $this->_unitOfWork->compatibilityRepo()->create($compatibility);

        $this->_unitOfWork->commit();
    }
}
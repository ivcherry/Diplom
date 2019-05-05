<?php

namespace App\BusinessLogic;

use App\Entities\GenericType;
use App\Repositories\UnitOfWork\UnitOfWork;
use App\ViewModels\GenericTypeViewModel;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

class GenericTypeManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function addGenericType(GenericType $genericType)
    {
        try
        {
            $this->_unitOfWork->typeRepository()->create($genericType);
            $this->_unitOfWork->commit();
        }
        catch(UniqueConstraintViolationException $exception)
        {
            $name = $genericType->getName();
            throw new Exception("Категория с наименованием $name уже существует");
        }

    }

    public function getAllGenericTypes(){
        $genericTypes = array();
        foreach ($this->_unitOfWork->genericTypeRepository()->all() as $genericType){
            array_push($genericTypes, $genericType->jsonSerialize());
        }
        return $genericTypes;
    }

    public function getGenericTypeEntityById($id){
        return $this->_unitOfWork->genericTypeRepository()->get($id);
    }

    public function getGenericTypeByName($name)
    {
        return $this->_unitOfWork->genericTypeRepository()->getGenericTypeByName($name);
    }

    public function getGenericTypeById($id)
    {
        if (empty($id)) {
            throw new Exception("Невозможно найти категорию. Отсутствует идентификатор.");
        }

        $genericType = $this->_unitOfWork->genericTypeRepository()->get($id);
        if (!isset($genericType)) {
            throw new Exception("Не найдена категория с идентификатором $id");
        }
        $viewModel = new GenericTypeViewModel();
        $viewModel->fillFromGenericTypeEntity($genericType);

        return $viewModel;
    }

    public function getPaginetedGenericTypes($pageSize, $pageNumber){
        $genericTypes = new ArrayCollection();
        $paginatedTypes = $this->_unitOfWork->genericTypeRepository()->getPaginatedGenericTypes($pageSize, $pageNumber);
        foreach($paginatedTypes->getData() as $genericType)
        {
            $viewModel = new GenericTypeViewModel();
            $viewModel->fillFromGenericTypeEntity($genericType);
            $viewModel->jsonSerialize();
            $genericTypes->add($viewModel);
        }
        $paginatedTypes->setData($genericTypes->toArray());
        return $paginatedTypes;
    }

    public function deleteGenericType($id){
        if(empty($id)){
            throw new Exception("Невозможно удалить категрию товара. Отсуствует идентификатор категории товара.");
        }

        $genericType = $this->_unitOfWork->genericTypeRepository()->get($id);
        if(!isset($genericType)){
            throw new Exception("Невозможно удалить категорию товара. Категория товара с идентификатором $id не найден.");
        }
        $this->_unitOfWork->typeRepository()->delete($genericType);
        $this->_unitOfWork->commit();
    }

    public function editGenericType(GenericType $newGenericType){
        if(empty($newGenericType->getId())){
            throw new Exception("Невозможно изменить категорию товара. Не указан идентификатор");
        }
        if(empty($newGenericType->getName())){
            throw new Exception("Невозможно изменить категорию товара. Не указано наименование категории");
        }
        $this->_unitOfWork->genericTypeRepository()->update($newGenericType);
        $this->_unitOfWork->commit();
    }

    public function getAllGenericTypesInCollection(){
        return new ArrayCollection($this->_unitOfWork->genericTypeRepository()->all());
    }
}
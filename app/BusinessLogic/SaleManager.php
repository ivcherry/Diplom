<?php

namespace App\BusinessLogic;

use App\Entities\Sale;
use App\Entities\Type;
use App\Repositories\UnitOfWork\UnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Exception;

class SaleManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAll()
    {
        return $this->_unitOfWork->saleRepository()->all();
    }

    public function getSalesByTitle($title)
    {
        if (!empty($title)) {
            return $this->_unitOfWork->saleRepository()->where("sales.title like %$title%");
        }
    }

    public function getSaleById($id)
    {
        return $this->_unitOfWork->saleRepository()->get($id);
    }

    public function addSale(Sale $sale)
    {
        try {
            $this->_unitOfWork->saleRepository()->create($sale);
            $this->_unitOfWork->commit();
        }
        catch (Exception $exception){
            $name = $sale->getTitle();
            throw new Exception("Категория с наименованием $name уже существует");
        }
    }

    public function getPaginate($pageSize, $pageNumber)
    {
        $sales = new ArrayCollection();
        $paginatedTypes = $this->_unitOfWork->saleRepository()->getPaginate($pageSize, $pageNumber);
        foreach ($paginatedTypes->getData() as $sale) {
            $saleSerialize = new Sale();
            $saleSerialize->fillFromSaleEntity($sale);
            $saleSerialize->jsonSerialize();
            $sales->add($saleSerialize);
        }
        $paginatedTypes->setData($sales->toArray());
        return $paginatedTypes;
    }

    public function edit(Sale $sale){
        if(empty($sale->getId())){
            throw new Exception("Невозможно изменить акцию. Не указан идентификатор");
        }
        if(empty($sale->getTitle())){
            throw new Exception("Невозможно изменить акцию. Не указан заголовок");
        }
        if(empty($sale->getSummary())){
            throw new Exception("Невозможно изменить акцию. Не указано краткое содержание");
        }
        if(empty($sale->getText())){
            throw new Exception("Невозможно изменить акцию. Не указан текст");
        }
        if(empty($sale->getDate())){
            throw new Exception("Невозможно изменить акцию. Не указана дата");
        }
        $this->_unitOfWork->saleRepository()->update($sale);
        $this->_unitOfWork->commit();
    }

    public function delete($id){
        if(empty($id)){
            throw new Exception("Невозможно удалить категрию товара. Отсуствует идентификатор категории товара.");
        }

        $sale = $this->_unitOfWork->saleRepository()->get($id);
        if(!isset($sale)){
            throw new Exception("Невозможно удалить категорию товара. Категория товара с идентификатором $id не найден.");
        }
        $this->_unitOfWork->saleRepository()->delete($sale);
        $this->_unitOfWork->commit();
    }

}


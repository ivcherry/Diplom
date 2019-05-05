<?php

namespace App\BusinessLogic;

use App\Entities\Order;
use App\Repositories\UnitOfWork\UnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Exception;

class OrderManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAll()
    {
        return $this->_unitOfWork->orderRepository()->all();
    }

    public function getOrdersByTitle($title)
    {
        if (!empty($title)) {
            return $this->_unitOfWork->orderRepository()->where("orders.title like %$title%");
        }
    }

    public function getOrderById($id)
    {
        return $this->_unitOfWork->orderRepository()->get($id);
    }

    public function addOrder(Order $order)
    {
        try {
            $this->_unitOfWork->orderRepository()->create($order);
            $this->_unitOfWork->commit();
        }
        catch (Exception $exception){
            $name = $order->getTitle();
            throw new Exception("Категория с наименованием $name уже существует");
        }
    }

    public function getPaginate($pageSize, $pageNumber)
    {
        $orders = new ArrayCollection();
        $paginatedTypes = $this->_unitOfWork->orderRepository()->getPaginate($pageSize, $pageNumber);
        foreach ($paginatedTypes->getData() as $order) {
            $orderSerialize = new Order();
            $orderSerialize->fillFromOrderEntity($order);
            $orderSerialize->jsonSerialize();
            $orders->add($orderSerialize);
        }
        $paginatedTypes->setData($orders->toArray());
        return $paginatedTypes;
    }

    public function edit(Order $order){
        if(empty($order->getId())){
            throw new Exception("Невозможно изменить акцию. Не указан идентификатор");
        }
        if(empty($order->getTitle())){
            throw new Exception("Невозможно изменить акцию. Не указан заголовок");
        }
        if(empty($order->getSummary())){
            throw new Exception("Невозможно изменить акцию. Не указано краткое содержание");
        }
        if(empty($order->getText())){
            throw new Exception("Невозможно изменить акцию. Не указан текст");
        }
        if(empty($order->getDate())){
            throw new Exception("Невозможно изменить акцию. Не указана дата");
        }
        $this->_unitOfWork->orderRepository()->update($order);
        $this->_unitOfWork->commit();
    }

    public function delete($id){
        if(empty($id)){
            throw new Exception("Невозможно удалить категрию товара. Отсуствует идентификатор категории товара.");
        }

        $order = $this->_unitOfWork->orderRepository()->get($id);
        if(!isset($order)){
            throw new Exception("Невозможно удалить категорию товара. Категория товара с идентификатором $id не найден.");
        }
        $this->_unitOfWork->orderRepository()->delete($order);
        $this->_unitOfWork->commit();
    }

}


<?php

namespace App\Entities;

use App\Entities\Review;
use App\Entities\Photo;
use App\Entities\ProductFeature;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

class Order implements JsonSerializable
{
    protected $id;

    protected $dateOfOrder;

    protected $user;

    protected $totalPrice;

    protected $products;

    protected $workScheduler;


    public function __construct()
    {
        $this->products = new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDateOfOrder()
    {
        return $this->dateOfOrder;
    }

    /**
     * @param mixed $dateOfOrder
     */
    public function setDateOfOrder($dateOfOrder)
    {
        $this->dateOfOrder = $dateOfOrder;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }


    public function addProducts($product)
    {
        if ($this->products == null) {
            $this->products = new ArrayCollection();
        }
        if ($this->products->contains($product)) {
            return;
        }
        $this->products->add($product);
    }

    public function fillFromOrderEntity(Order $order)
    {
        $this->id = $order->getId();
        $this->dateOfOrder = $order->getDateOfOrder();
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->getDateOfOrder()->format('Y-m-d'),
            'id' => $this->getId()
        ];
    }
}
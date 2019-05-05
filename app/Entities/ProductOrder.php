<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.11.2017
 * Time: 0:48
 */

namespace App\Entities;


class ProductOrder
{
    protected $id;
    protected $product;
    protected $order;
    protected $amount;
    protected $price;
    protected $productOrders;

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
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProductOrders()
    {
        return $this->productOrders;
    }

    /**
     * @param mixed $productOrders
     */
    public function setProductOrders($productOrders)
    {
        $this->productOrders = $productOrders;
    }

}
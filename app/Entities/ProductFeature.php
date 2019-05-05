<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.11.2017
 * Time: 0:48
 */

namespace App\Entities;


class ProductFeature
{
    protected $id;
    protected $product;
    protected $feature;
    protected $value;
    protected $productFeatures;

    /**
     * @return mixed
     */
    public function getProductFeatures()
    {
        return $this->productFeatures;
    }

    /**
     * @param mixed $productFeatures
     */
    public function setProductFeatures($productFeatures)
    {
        $this->productFeatures = $productFeatures;
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
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }


    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return Feature
     */
    public function getFeature()
    {
        return $this->feature;
    }

    public function setFeature($feature)
    {
        $this->feature = $feature;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}
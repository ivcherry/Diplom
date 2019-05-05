<?php

namespace App\Entities;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entities\GenericType;
use App\Entities\Feature;
use JsonSerializable;

class Type implements JsonSerializable
{
    protected $id;

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

    protected $name;

    /** @var \Doctrine\Common\Collections\Collection */
    protected $products;

    protected $genericType;

    protected $features;

    /**
     * @return GenericType
     */
    public function getGenericType()
    {
        return $this->genericType;
    }

    /**
     * @param mixed $genericType
     */
    public function setGenericType($genericType)
    {
        $this->genericType = $genericType;
    }

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->features = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function addProduct(Product $product)
    {
        if (!$this->products->contains($product))
        {
            $product->setType($this);
            $this->products->add($product);
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getFeatures()
    {
        return $this->features;
    }

    public function addFeature(Feature $feature)
    {
        if ($this->features->contains($feature))
        {
            return;
        }

        $this->features->add($feature);
    }

    public function deleteFeature(Feature $feature){
        if($this->features->contains($feature)){
            $this->features->removeElement($feature);
        }
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return[
            'name' => $this->getName(),
            'id' => $this->getId(),
            'genericTypes' => $this->getGenericType()->getName()
        ];
    }
}
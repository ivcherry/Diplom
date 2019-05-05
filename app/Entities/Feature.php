<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

class Feature implements JsonSerializable
{
    protected $id;

    protected $name;

    protected $types;

    protected $products;

    protected $compatibility;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function addType(Type $type)
    {
        if ($this->types->contains($type)) {
            return;
        }
        $this->types->add($type);
    }

    public function deleteType(Type $type){
        if($this->types->contains($type)){
            $this->types->removeElement($type);
        }
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

    public function getProducts(){
        return $this->products;
    }

    public function addProduct($product){
        if($this->products->contains($product)){
            return;
        }
        $this->products->add($product);
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'id' => $this->getId()
        ];
    }

}

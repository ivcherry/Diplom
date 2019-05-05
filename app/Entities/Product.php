<?php

namespace App\Entities;

use App\Entities\Review;
use App\Entities\Photo;
use App\Entities\ProductFeature;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

class Product implements JsonSerializable
{
    protected $id;

    protected $name;

    protected $price;

    protected $type;

    protected $description;

    protected $amount;

    protected $reviews;

    protected $photos;

    protected $features;

    protected $orders;

    /**
     * @return ArrayCollection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param ArrayCollection $orders
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
    }

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->features = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @return ArrayCollection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    public function getFeatures(){
        return $this->features;
    }

    public function addReview(Review $review)
    {
        if ($this->reviews == null) {
            $this->reviews = new ArrayCollection();
        }

        if ($this->reviews->contains($review)) {
            return;
        }

        $this->reviews->add($review);
    }

    public function addPhoto(Photo $photo)
    {
        if ($this->photos == null) {
            $this->photos = new ArrayCollection();
        }

        if ($this->photos->contains($photo)) {
            return;
        }

        $this->photos->add($photo);
    }

    public function addFeature($feature){
        if ($this->features == null) {
            $this->features = new ArrayCollection();
        }
        if ($this->features->contains($feature)) {
            return;
        }
        $this->features->add($feature);
    }

    public function addOrder($order){
        if ($this->orders == null) {
            $this->orders = new ArrayCollection();
        }
        if ($this->orders->contains($order)) {
            return;
        }
        $this->orders->add($order);
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param mixed $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }

    protected $producer;

    /**
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(Type $type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
        $mainPhoto = $this->getPhotos()->isEmpty()
            ? null
            : $this->getPhotos()->first()->getImage();
        $reviews = $this->getReviews()->isEmpty()
            ? null
            : $this->getReviews()->count();
        return [
            'name' => $this->getName(),
            'id' => $this->getId(),
            'price' => $this->getPrice(),
            'type' => $this->getType()->getName(),
            'description' => $this->getDescription(),
            'amount' => $this->getAmount(),
            'genericType' => $this->getType()->getGenericType()->getName(),
            'productImage' => $mainPhoto,
            'reviews' => $reviews
        ];
    }
}
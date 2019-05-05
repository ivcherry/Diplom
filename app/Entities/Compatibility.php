<?php

namespace App\Entities;
use JsonSerializable;

class Compatibility implements JsonSerializable{

    private $id;
    private $firstType;
    private $firstFeature;
    private $secondType;
    private $secondFeature;
    private $rule;

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
    public function getFirstType()
    {
        return $this->firstType;
    }

    /**
     * @param mixed $firstType
     */
    public function setFirstType($firstType)
    {
        $this->firstType = $firstType;
    }

    /**
     * @return mixed
     */
    public function getFirstFeature()
    {
        return $this->firstFeature;
    }

    /**
     * @param mixed $firstFeature
     */
    public function setFirstFeature($firstFeature)
    {
        $this->firstFeature = $firstFeature;
    }

    /**
     * @return mixed
     */
    public function getSecondType()
    {
        return $this->secondType;
    }

    /**
     * @param mixed $secondType
     */
    public function setSecondType($secondType)
    {
        $this->secondType = $secondType;
    }

    /**
     * @return mixed
     */
    public function getSecondFeature()
    {
        return $this->secondFeature;
    }

    /**
     * @param mixed $secondFeature
     */
    public function setSecondFeature($secondFeature)
    {
        $this->secondFeature = $secondFeature;
    }

    /**
     * @return mixed
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param mixed $rule
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
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
        return [
            'id' => $this->getId(),
            'firstType' => $this->getFirstType()->getName(),
            'secondType' => $this->getSecondType()->getName(),
            'firstFeature' => $this->getFirstFeature()->getName(),
            'secondFeature' => $this->getSecondFeature()->getName(),
            'rule' => $this->getRule()
        ];
    }
}
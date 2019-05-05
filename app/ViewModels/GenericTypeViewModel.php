<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.11.2017
 * Time: 23:37
 */

namespace App\ViewModels;

use App\Entities\GenericType;
use JsonSerializable;

class GenericTypeViewModel implements JsonSerializable
{

    private $id;
    private $name;

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

    public function fillFromGenericTypeEntity(GenericType $genericType)
    {
        $this->id = $genericType->getId();
        $this->name = $genericType->getName();
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'id' => $this->getId()
        ];
    }
}
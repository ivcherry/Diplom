<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.10.2017
 * Time: 18:04
 */

namespace App\Entities;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

class GenericType implements JsonSerializable
{
    protected $id;
    protected $name;
    protected $types;

    public function addGenericType(Type $type)
    {
        if (!$this->types->contains($type))
        {
            $type->setGenericType($this);
            $this->types->add($type);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getTypes()
    {
        return $this->types;
    }

    public function __construct()
    {
        $this->types = new ArrayCollection();
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
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'id' => $this->getId()
        ];
    }
}
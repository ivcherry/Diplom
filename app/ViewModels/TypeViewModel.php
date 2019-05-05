<?php
namespace App\ViewModels;
use App\Entities\Type;
use JsonSerializable;

class TypeViewModel implements JsonSerializable
{
    private $id;

    /**
     * @return mixed
     */

    private $name;

    private $genericTypeId;

    private $genericTypeName;

    /**
     * @return mixed
     */
    public function getGenericTypeId()
    {
        return $this->genericTypeId;
    }

    /**
     * @param mixed $genericTypeId
     */
    public function setGenericTypeId($genericTypeId)
    {
        $this->genericTypeId = $genericTypeId;
    }

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

    public function getGenericTypeName(){
        return $this->genericTypeName;
    }

    public function fillFromType(Type $type){
        $this->id = $type->getId();
        $this->name = $type->getName();
        $this->genericTypeId = $type->getGenericType()->getId();
        $this->genericTypeName = $type->getGenericType()->getName();
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
            'id' => $this->getId(),
            'genericTypeName' => $this->getGenericTypeName()
        ];
    }

}
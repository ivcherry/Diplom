<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

class Role
{
    /**
     * Properties
     *
     */
    protected $id;

    protected $name;

    protected $description;

    protected $users;


    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function addUser(User $user)
    {
        if ($this->users == null)
        {
            $this->users = new ArrayCollection();
        }
        if ($this->users->contains($user))
        {
            return;
        }
        $this->users->add($user);
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
}
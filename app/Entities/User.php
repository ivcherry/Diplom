<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

class User implements \Illuminate\Contracts\Auth\Authenticatable, JsonSerializable
{
    /**
     * Properties
     */

    protected $id;

    protected $password;

    protected $rememberToken;

    protected $email;

    protected $fullName;

    protected $roles;

    protected $orders;

    protected $workSchedulers;

    /**
     * @return ArrayCollection
     */
    public function getWorkSchedulers()
    {
        return $this->workSchedulers;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->workSchedulers = new ArrayCollection();
    }

    public function addWorkScheduler(WorkScheduler $workScheduler)
    {
        if ($this->workSchedulers->contains($workScheduler)) {
            return;
        }

        $this->workSchedulers->add($workScheduler);
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

    public function addRole(Role $role)
    {
        if ($this->roles->contains($role)) {
            return;
        }

        $this->roles->add($role);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getId();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->getPassword();
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        $this->rememberToken;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $rememberToken
     * @return void
     */
    public function setRememberToken($rememberToken)
    {
        $this->rememberToken = $rememberToken;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return "rememberToken";
    }

    public function jsonSerialize()
    {
        return [
            'fullName' => $this->getFullName(),
            'email' => $this->getEmail(),
            'id' => $this->getId()
        ];
    }

    public function resetRoles()
    {
        $this->roles = new ArrayCollection();
    }
}

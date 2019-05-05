<?php

namespace App\Entities;

use Faker\Provider\DateTime;
use JsonSerializable;

class WorkScheduler implements JsonSerializable
{
    protected $id;

    protected $date;

    protected $timeSlot;

    protected $user;

    protected $order;

    protected $status;

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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTimeSlot()
    {
        return $this->timeSlot;
    }

    /**
     * @param mixed $timeSlot
     */
    public function setTimeSlot($timeSlot)
    {
        $this->timeSlot = $timeSlot;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'date' => $this->getDate()->format('Y-m-d'),
            'timeSlot' => $this->getTimeSlot(),
            'user' => $this->getUser(),
            'order' => $this->getOrder(),
            'status' => $this->getStatus()
        ];
    }
}

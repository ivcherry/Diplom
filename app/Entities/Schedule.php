<?php

namespace App\Entities;

use Faker\Provider\DateTime;
use JsonSerializable;

class Schedule
{
    protected $id;

    protected $day;

    protected $timeSlots;

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
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getTimeSlots()
    {
        return $this->timeSlots;
    }

    /**
     * @param mixed $timeSlots
     */
    public function setTimeSlots($timeSlots)
    {
        $this->timeSlots = $timeSlots;
    }

}

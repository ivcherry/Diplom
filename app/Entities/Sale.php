<?php

namespace App\Entities;

use Faker\Provider\DateTime;
use JsonSerializable;

class Sale implements JsonSerializable
{
    protected $id;

    protected $title;

    protected $summary;

    protected $text;

    protected $date;


    public function getDate()
    {
        if ($this->date == null) {
            return "";
        }
        return $this->date->format('Y-m-d');
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = date_create($date);
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    public function fillFromSaleEntity(Sale $sale)
    {
        $this->id = $sale->getId();
        $this->title = $sale->getTitle();
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'id' => $this->getId()
        ];
    }
}

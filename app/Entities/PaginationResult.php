<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.11.2017
 * Time: 1:41
 */

namespace App\Entities;
use JsonSerializable;

class PaginationResult implements JsonSerializable
{
    private $_data;
    private $_count;

    public function __construct($data, $count)
    {
        $this->_data = $data;
        $this->_count = $count;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function getCount()
    {
        return $this->_count;
    }

    public function setCount($count)
    {
        $this->_count = $count;
    }

    function jsonSerialize()
    {
        return array(
            'data' => $this->_data,
            'count' => $this->_count
        );
    }
}
<?php
namespace App\ViewModels;

use JsonSerializable;

class JsonResult implements JsonSerializable {

    private $data;
    private $success;
    private $message;

    public function __construct($data = null, $success, $message = null)
    {
        $this->data = $data;
        $this->success = $success;
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return array(
            [
                'data' => $this->data,
                'success' => $this->success,
                'message' => $this->message
            ]
        );
    }
}
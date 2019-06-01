<?php

namespace App\BusinessLogic;

use App\Repositories\UnitOfWork\UnitOfWork;

class ScheduleManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAll()
    {
        return $this->_unitOfWork->scheduleRepository()->all();
    }
}


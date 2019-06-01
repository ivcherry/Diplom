<?php

namespace App\BusinessLogic;

use App\Repositories\UnitOfWork\UnitOfWork;

class WorkSchedulerManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAll()
    {
        return $this->_unitOfWork->workSchedulerRepository()->all();
    }

    public function updateStateBusy($id)
    {
        $workScheduler = $this->_unitOfWork->workSchedulerRepository()->get($id);
        $workScheduler->setStatus(2);
        $this->_unitOfWork->workSchedulerRepository()->update($workScheduler);
        $this->_unitOfWork->commit();
    }
}


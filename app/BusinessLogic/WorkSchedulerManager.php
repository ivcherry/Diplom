<?php

namespace App\BusinessLogic;

use App\Entities\Sale;
use App\Entities\Type;
use App\Repositories\UnitOfWork\UnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Exception;

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


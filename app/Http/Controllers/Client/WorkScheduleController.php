<?php
/**
 * Created by PhpStorm.
 * User: EvgeniySharipov
 * Date: 06.11.2017
 * Time: 22:45
 */

namespace App\Http\Controllers\Client;

use App\BusinessLogic\OrderManager;
use App\BusinessLogic\UserManager;
use App\BusinessLogic\WorkSchedulerManager;
use App\Entities\Order;
use App\Entities\Type;
use App\Http\Controllers\Controller;
use App\BusinessLogic\TypeManager;
use Illuminate\Http\Request;
use App\ViewModels\TypeViewModel;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UnitOfWork\UnitOfWork;

class WorkScheduleController extends Controller
{
    private $_workScheduleManager;

    public function __construct(WorkSchedulerManager $workSchedulerManager)
    {
        $this->_workScheduleManager = $workSchedulerManager;
    }
    public function getAllWorkScheduler(Request $request)
    {

        $workSchedulers = $this->_workScheduleManager->getAll();

        return $workSchedulers;
    }

    public function updateState(Request $request, $id)
    {
        $shId = $request->id_work_scheduler;
        if(empty($shId)){
            $shId = $id;
        }
        $this->_workScheduleManager->updateStateBusy($shId);

        return $request->id_work_scheduler;
    }
}
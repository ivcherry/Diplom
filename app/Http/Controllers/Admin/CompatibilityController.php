<?php

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\TypeManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class CompatibilityController extends Controller{

    private $_typeManager;

    public function __construct(TypeManager $typeManager)
    {
        $this->_typeManager = $typeManager;
    }
    public function index(){
        return view('admin.compatibilities.index');
    }

    public function getPaginatedCompatibilities(Request $request){
        $paginatedResult = $this->_typeManager->getPaginatedCompatibilities($request->pageSize, $request->page);

        return ['compatibilities' => $paginatedResult->getData(), 'total' => $paginatedResult->getCount()];
    }

    public function getCompatibilityById(Request $request, $id){

        $compatibilityId = $request->id;

        $compatibilityModel = $this->_typeManager->getCompatibilityById($compatibilityId);

        $view = view('admin.compatibilities._compatibilityPartialView', compact("compatibilityModel"));
        return response($view);
    }

    public function deleteCompatibility(Request $request){

        try{

            $compatibilityId = $request->id;
            $this->_typeManager->deleteCompatibilityById($compatibilityId);

            return $this->jsonSuccessResult();
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function addCompatibility(Request $request){
        try{
            $rule = $request->rule;
            $firstTypeId = $request->firstTypeId;
            $secondTypeId  = $request->secondTypeId;
            $firstFeatureId = $request->firstFeatureId;
            $secondFeatureId = $request->secondFeatureId;

            $this->_typeManager->addCompatibility($firstTypeId, $secondTypeId, $firstFeatureId, $secondFeatureId, $rule);
            return $this->jsonSuccessResult();
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }

    }
}
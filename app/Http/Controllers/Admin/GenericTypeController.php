<?php
/**
 * Created by PhpStorm.
 * User: EvgeniySharipov
 * Date: 18.11.2017
 * Time: 10:50
 */

namespace App\Http\Controllers\Admin;
use App\BusinessLogic\GenericTypeManager;
use App\Http\Controllers\Controller;
use App\ViewModels\GenericTypeViewModel;
use Illuminate\Http\Request;
use App\Entities\GenericType;
use Exception;

class GenericTypeController extends Controller
{
    private $_genericTypeManager;

    public function __construct(GenericTypeManager $genericTypeManager)
    {
        $this->_genericTypeManager = $genericTypeManager;
    }

    public function index()
    {
        return view('admin.categories.index');
    }

    public function getAllGenericTypes(Request $request){
        $response = $this->_genericTypeManager->getAllGenericTypes();
        return ($response);
    }

    public function getPaginatedGenericTypes(Request $request)
    {
        $paginatedGenericTypes = $this->_genericTypeManager->getPaginetedGenericTypes($request->pageSize, $request->page);

        return ['genericTypes' => $paginatedGenericTypes->getData(), 'total' => $paginatedGenericTypes->getCount()];
    }

    public function getGenericTypeById(Request $request, $id)
    {
        $genericTypeId = $request->id;

        $genericTypeModel = $this->_genericTypeManager->getGenericTypeById($genericTypeId);

        $view = view('admin.categories._categoryPartialView', compact("genericTypeModel"));
        return response($view);
    }

    public function addGenericType(Request $request){
        try{
            $genericType = new GenericType();
            $genericType->setName($request->name);
            $genericType->setId($request->id);

            $this->_genericTypeManager->addGenericType($genericType);

            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }

    }

    public function deleteGenericType(Request $request){
        try{
            $genericTypeId = $request->id;
            $this->_genericTypeManager->deleteGenericType($genericTypeId);

            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function editGenericType(Request $request){
        try{
            $newGenericType = new GenericType();
            $newGenericType->setId($request->id);
            $newGenericType->setName($request->name);

            $this->_genericTypeManager->editGenericType($newGenericType);
            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }
}
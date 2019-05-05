<?php

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\FeatureManager;
use App\Http\Controllers\Controller;
use App\ViewModels\FeatureViewModel;
use Illuminate\Http\Request;
use App\Entities\Feature;
use Exception;

class FeatureController extends Controller
{
    private $_featureManager;

    public function __construct(FeatureManager $featureManager)
    {
        $this->_featureManager = $featureManager;
    }

    public function index()
    {
        return view('admin.features.index');
    }

    public function getAllFeatures(Request $request){
        $response = $this->_featureManager->getAllFeatures();
        return ($response);
    }

    public function getFeatureById(Request $request, $id)
    {
        $featureId = $request->id;

        $featureModel = $this->_featureManager->getFeatureById($featureId);

        $view = view('admin.features._featurePartialView', compact("featureModel"));
        return response($view);
    }

    public function addFeature(Request $request){
        try{
            $feature = new Feature();
            $feature->setName($request->name);
            $feature->setId($request->id);

            $this->_featureManager->addFeature($feature);

            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }

    }

    public function deleteFeature(Request $request){
        try{
            $featureId = $request->id;
            $this->_featureManager->deleteFeature($featureId);

            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function editFeature(Request $request){
        try{
            $newFeature = new Feature();
            $newFeature->setId($request->id);
            $newFeature->setName($request->name);

            $this->_featureManager->editFeature($newFeature);
            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function getPaginatedFeatures(Request $request)
    {
        $paginatedFeatures = $this->_featureManager->getPaginetedFeatures($request->pageSize, $request->page);

        return ['features' => $paginatedFeatures->getData(), 'total' => $paginatedFeatures->getCount()];
    }

    public function getFeaturesByTypeId(Request $request, $typeId){
        $features = $this->_featureManager->getFeaturesByTypeId($typeId);

        return $features;
    }


}

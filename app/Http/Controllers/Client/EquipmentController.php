<?php

namespace App\Http\Controllers\Client;

use App\BusinessLogic\ProductManager;
use App\BusinessLogic\TypeManager;
use App\Entities\Equipment;
use App\Entities\ProductsFilter;
use App\Helpers\EquipmentHelper;
use App\Http\Controllers\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Request;
use Session;
use Exception;
use App\Entities\ProductInfo;

class EquipmentController extends Controller{

    private $_defaultStage = 'processor';
    private $_equipmentHelper;
    private $_typeManager;
    private $_productManager;
    private $_pageSize = 10;
    public function __construct(EquipmentHelper $equipmentHelper, TypeManager $typeManager, ProductManager $productManager)
    {
        $this->_equipmentHelper = $equipmentHelper;
        $this->_typeManager = $typeManager;
        $this->_productManager = $productManager;
    }

    public function resetEquipment(Request $request){
        if(Session::has('equipment')){
            Session::remove('equipment');
        }

        return redirect('/equipment');
    }
    public function currentEquipmentStage(Request $request)
    {
        $currentStage = null;
        $equipment = null;
        if (Session::has('equipment')) {
            $equipment = Session::get('equipment');
            $currentStage = $equipment->getCurrentStage();
            if($currentStage == $this->_equipmentHelper->getFinalStage()){
               if($equipment->checkAllStages()){
                   $products = new ArrayCollection();
                   $productIds = $equipment->getProductsIds();
                   $resultSum = 0.0;
                   foreach ($productIds as $productId){
                       $product = $this->_productManager->getProductById($productId);
                        $products->add($product);
                       $resultSum += $product->getPrice();
                   }
                   return view('client.equipment.finalStage', ['products' => $products, 'resultSum' => $resultSum]);
               }
            }
            else{
                $currentEquipmentName = $this->_equipmentHelper->getEquipmentViewName($currentStage);
                return view('client.equipment.equipment', ['equipmentStage' => $currentStage, 'equipmentName' => $currentEquipmentName]);
            }
        }
        else {
            $equipment = new Equipment();
            $equipment->setCurrentStage($this->_equipmentHelper->getFirstStage());
            $currentStage = $equipment->getCurrentStage();
            Session::put('equipment', $equipment);
            $currentEquipmentName = $this->_equipmentHelper->getEquipmentViewName($currentStage);
            return view('client.equipment.equipment', ['equipmentStage' => $currentStage, 'equipmentName' => $currentEquipmentName]);
        }
    }

    public function getPaginatedProductsByEquipmentStage(Request $request)
    {
            $equipmentStage = $request->equipmentStage;
            if (Session::has('equipment')) {
                $equipment = Session::get('equipment');
                $currentStage = $equipment->getCurrentStage();
                $type = $this->_typeManager->getTypeByName($this->_equipmentHelper->getTypeNameByStage($equipmentStage));
                if ($equipment->isFirstStage($currentStage)) {
                    $filter = new ProductsFilter();
                    $filter->setTypeId($type->getId());
                    $products = $this->_productManager->getPaginatedProductsWithFilter($filter, $request->pageSize, $request->page);

                    return ['products' => $products->getData(), 'total' => $products->getCount()];
                } else {
                    $previousStage = $this->_equipmentHelper->getPreviousEquipmentStage($currentStage);
                    $productId = $equipment->getProductIdByStage($previousStage);
                    if (isset($productId)) {
                        $products = $this->_productManager->getPaginatedProductsByEquipmentProfile($productId, $type->getId(), $request->pageSize, $request->page);
                        return ['products' => $products->getData(), 'total' => $products->getCount()];
                    }
                }
            }
    }

    public function addProductToEquipment(Request $request){
        $productId = $request->prodId;
        $currentStage = $request->currentStage;

        if(Session::has('equipment')){
            $equipment = Session::get('equipment');
            if($equipment->checkCurrentStage($currentStage)){
                $equipment->setProductIdByStage($currentStage, $productId);
                $nextStage = $this->_equipmentHelper->getNextEquipmentStage($currentStage);
                $equipment->setCurrentStage($nextStage);
                Session::put('equipment', $equipment);
                return $this->jsonSuccessResult();
            }
        }
    }

    public function checkoutEquipment(Request $request){
        try {
            $checkoutInfo = json_decode($request->order);

            if (isset($checkoutInfo) && count($checkoutInfo->products) > 0 && !empty($checkoutInfo->orderPrice)) {
                $summaryPrice = $this->_productManager->checkOrderProducts($checkoutInfo->products);
                if ($summaryPrice == floatval($checkoutInfo->orderPrice)) {
                    $productsInfo = new ArrayCollection();
                    foreach ($checkoutInfo->products as $product) {
                        $productInfo = new ProductInfo();
                        $productInfo->setProductInfo($product->productId, $product->productAmount);
                        $productsInfo->add($productInfo);
                    }
                    if(!$productsInfo->isEmpty()){
                        $this->_productManager->saveOrder($productsInfo);
                        if(Session::has('equipment')){
                            Session::remove('equipment');
                        }
                        return $this->jsonSuccessResult();
                    }

                }
            }
        } catch (Exception $e) {
            return $this->jsonFaultResult($e->getMessage());
        }
    }

}
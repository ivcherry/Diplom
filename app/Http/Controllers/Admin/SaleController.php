<?php
/**
 * Created by PhpStorm.
 * User: EvgeniySharipov
 * Date: 06.11.2017
 * Time: 22:45
 */

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\SaleManager;
use App\Entities\Sale;
use App\Entities\Type;
use App\Http\Controllers\Controller;
use App\BusinessLogic\TypeManager;
use Illuminate\Http\Request;
use App\ViewModels\TypeViewModel;
use Exception;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    private $_saleManager;

    public function __construct(SaleManager $saleManager)
    {
        $this->_saleManager = $saleManager;
    }

    public function getPaginate(Request $request)
    {
        $paginatedSales = $this->_saleManager->getPaginate($request->pageSize, $request->page);

        return ['sales' => $paginatedSales->getData(), 'total' => $paginatedSales->getCount()];
    }

    public function index()
    {
        return view('admin.sale.index');
    }

    public function getAllSales(Request $request)
    {

        $paginationTypes = $this->_saleManager->getPaginate($request->pageSize, $request->page);

        return ['sales' => $paginationTypes->getData(), 'total' => $paginationTypes->getCount()];
    }

    public function getSaleById(Request $request, $id)
    {
        $saleModel = $this->_saleManager->getSaleById($id);
        $view = view('admin.sale._salePartialView', compact('saleModel'));
        return response($view);
    }

    public function edit(Request $request)
    {
        try {
            $saleModel = new Sale();
            $saleModel->setTitle($request->title);
            $saleModel->setId($request->id);
            $saleModel->setSummary($request->summary);
            $saleModel->setText($request->text);
            $saleModel->setDate($request->date);

            $this->_saleManager->edit($saleModel);

            return $this->jsonSuccessResult(null);
        } catch (\Exception $e) {
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $typeId = $request->id;
            $this->_saleManager->delete($typeId);
            return $this->jsonSuccessResult(null);
        } catch (Exception $e) {
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function add(Request $request)
    {

        try {
            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|string|'
                ],
                [
                    'title.required' => 'Поле "Наименование" должно быть заполнено.'
                ]);
            if ($validator->passes()) {
                $saleModel = new Sale();
                $saleModel->setTitle($request->title);
                $saleModel->setId($request->id);
                $saleModel->setSummary($request->summary);
                $saleModel->setText($request->text);
                $saleModel->setDate($request->date);
                $this->_saleManager->addSale($saleModel);
                return $this->jsonSuccessResult(null);
            }
            return $this->jsonFaultResult($validator->errors()->all());
        } catch (Exception $e) {
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }
}
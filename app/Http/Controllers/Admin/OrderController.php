<?php
/**
 * Created by PhpStorm.
 * User: EvgeniySharipov
 * Date: 06.11.2017
 * Time: 22:45
 */

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\OrderManager;
use App\BusinessLogic\ProductManager;
use App\BusinessLogic\ProductOrderManager;
use App\Entities\Order;
use App\Entities\Type;
use App\Http\Controllers\Controller;
use App\BusinessLogic\TypeManager;
use Illuminate\Http\Request;
use App\ViewModels\TypeViewModel;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UnitOfWork\UnitOfWork;

class OrderController extends Controller
{
    private $_orderManager;
    private $_productManager;
    private $_productOrderManager;

    public function __construct(OrderManager $orderManager, ProductManager $productManager, ProductOrderManager $productOrderManager)
    {
        $this->_orderManager = $orderManager;
        $this->_productManager = $productManager;
        $this->_productOrderManager = $productOrderManager;
    }

    public function getPaginate(Request $request)
    {
        $paginatedOrders = $this->_orderManager->getPaginate($request->pageSize, $request->page);

        return ['orders' => $paginatedOrders->getData(), 'total' => $paginatedOrders->getCount()];
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function getAllOrders(Request $request)
    {

        $paginationTypes = $this->_orderManager->getPaginate($request->pageSize, $request->page);

        return ['orders' => $paginationTypes->getData(), 'total' => $paginationTypes->getCount()];
    }

    public function getOrderById(Request $request, $id)
    {
        $orderModel = $this->_orderManager->getOrderById($id);
        $products = $orderModel->getProducts();

        $view = view('admin.orders._orderPartialView', compact('orderModel', 'products'));
        return response($view);
    }

    public function edit(Request $request)
    {
        try {
            $orderModel = new Order();
            $orderModel->setTitle($request->dateOfOrder);
            $orderModel->setId($request->id);
            $orderModel->setSummary($request->summary);
            $orderModel->setText($request->text);
            $orderModel->setDate($request->date);

            $this->_orderManager->edit($orderModel);

            return $this->jsonSuccessResult(null);
        } catch (\Exception $e) {
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $typeId = $request->id;
            $this->_orderManager->delete($typeId);
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
                $orderModel = new Order();
                $orderModel->setTitle($request->title);
                $orderModel->setId($request->id);
                $orderModel->setSummary($request->summary);
                $orderModel->setText($request->text);
                $orderModel->setDate($request->date);
                $this->_orderManager->addOrder($orderModel);
                return $this->jsonSuccessResult(null);
            }
            return $this->jsonFaultResult($validator->errors()->all());
        } catch (Exception $e) {
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }
}
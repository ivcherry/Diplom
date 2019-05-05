<?php

namespace App\Http\Controllers\Client;

use App\BusinessLogic\ProductManager;
use App\Entities\ProductInfo;
use App\Http\Controllers\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Request;
use Session;
use App\Entities\Cart;
use Exception;

class OrderController extends Controller{

    private $_productManager;
    public function __construct(ProductManager $productManager)
    {
        $this->_productManager = $productManager;
    }

    public function index(){
        if(Session::has('cart')){
            $cart = Session::get('cart');

            $productsIds = $cart->getProductsIds();
            $products = new ArrayCollection();
            $resultSum = 0;
            foreach ($productsIds as $productsId){
                $product = $this->_productManager->getProductById($productsId);
                $products->add($product);
                $resultSum += $product->getPrice();
            }

            return view('client.order.shoppingCart', ['products' => $products, 'resultSum' => $resultSum]);
        }else{
            return view('client.order.shoppingCart', ['products' => null]);
        }
    }

    public function addToCart(Request $request){
        $productId = $request->prodId;
        if(isset($productId)){
            $cart = null;
            if(Session::has('cart')){
                $cart = Session::get('cart');
            }
            else{
                $cart = new Cart();
            }
            $productInfo = new ProductInfo();
            $productInfo->setProductInfo($productId, 1);
            $cart->addProduct($productInfo);
            Session::put('cart', $cart);

            return $this->jsonSuccessResult(['productsCount' => $cart->getProductsCount()]);
        }
        else{
            return $this->jsonFaultResult('Ошибка добавления товара в корзину.');
        }
    }

    public function checkAndUpdateProductInfo(Request $request){
        $productId = $request->currentProductId;
        $productAmount = $request->currentProductAmount;

        $product = $this->_productManager->getProductById($productId);
        if($product->getAmount() >= $productAmount){
            $resultPrice = $productAmount*$product->getPrice();
            return $this->jsonSuccessResult(['productPrice' => $resultPrice]);
        }
        else{
            return $this->jsonFaultResult('Товар в данном количестве отсутствует. Выберите меньшее количество.');
        }
    }

    public function deleteProduct(Request $request){
        $productId = $request->productId;
        if(isset($productId)){
          if(Session::has('cart')){
              $cart = Session::get('cart');

              $cart->deleteProduct($productId);

              $productsCount = $cart->getProductsCount();
              if($productsCount == 0){
                  Session::remove('cart');
              }
              else{
                  Session::put('cart', $cart);
              }
          }

          return $this->jsonSuccessResult(['productsCount' => $productsCount]);
        }
        else{
            return $this->jsonFaultResult('Ошибка удаления товара из корзины');
        }
    }

    public function checkout(Request $request){
        try {
            $checkoutInfo = json_decode($request->order);

            if (isset($checkoutInfo) && count($checkoutInfo->products) > 0 && !empty($checkoutInfo->orderPrice)) {
                $summaryPrice = $this->_productManager->checkOrderProducts($checkoutInfo->products);
                if($summaryPrice == floatval($checkoutInfo->orderPrice)){
                    if(Session::has('cart')){
                        $cart = Session::get('cart');

                        foreach ($checkoutInfo->products as $product){
                            $productInfo = new ProductInfo();
                            $productInfo->setProductInfo($product->productId, $product->productAmount);
                            $cart->updateProductInfo($productInfo);
                        }
                        Session::put('cart', $cart);
                        return $this->jsonSuccessResult();
                    }
                }
            }
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function mainOrder(Request $request){
       if(strpos($request->header('referer'),'shoppingCart') !== false){
           if(Session::has('cart')){
               $cart = Session::get('cart');
               $summaryPrice = $this->_productManager->checkOrderProducts($cart->getProductsInfo());

               return view('client.order.order', ['summaryPrice' => $summaryPrice]);
           }else{
               return redirect('/shoppingCart');
           }
       }
       else{
           return redirect('/shoppingCart');
       }
    }

    public function saveOrder(Request $request){
        try{
            $phone = $request->phoneNumber;
            $receivingTime = $request->receivingTime;
            if(Session::has('cart')){
                $cart = Session::get('cart');
                $productsInfo = $cart->getProductsInfo();
                if(!$productsInfo->isEmpty()){
                    $this->_productManager->saveOrder($productsInfo);
                    Session::remove('cart');
                    return redirect('/thanksForPurchase');
                }
            }
        }
        catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function thanksForPurchase(Request $request){
        if(strpos($request->header('referer'),'order') !== false || strpos($request->header('referer'),'equipment') !== false ) {
            return view('client.order.purchaseThanks');
        }
        else{
            return abort(404);
        }
    }
}
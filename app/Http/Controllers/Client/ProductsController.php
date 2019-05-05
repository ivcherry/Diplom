<?php

namespace App\Http\Controllers\Client;

use App\BusinessLogic\GenericTypeManager;
use App\BusinessLogic\ProductManager;
use App\BusinessLogic\TypeManager;
use App\Entities\Type;
use App\Http\Controllers\Controller;
use App\Entities\ProductsFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Request;
use Session;

class ProductsController extends Controller{

    private $_productManager;
    private $_typeManager;
    private $_genericTypeManager;

    public function __construct(ProductManager $productManager, TypeManager $typeManager, GenericTypeManager $genericTypeManager)
    {
        $this->_productManager = $productManager;
        $this->_typeManager = $typeManager;
        $this->_genericTypeManager = $genericTypeManager;
    }

    public function getAllProducts(Request $request){
        $filter = $request->filter;
        $productsFilter = new ProductsFilter();
        $productsFilter->setProductName($filter['productName']);
        $productsFilter->setTypeId($filter['subCategory']);
        $productsFilter->setOrderByPrice($filter['orderByPrice']);

        $paginatedProducts = $this->_productManager->getPaginatedProductsWithFilter($productsFilter, $request->pageSize, $request->page);


        return ['products' => $paginatedProducts->getData(), 'total' => $paginatedProducts->getCount()];
    }

    public function index(Request $request){
        $subCategoryId = $request->subCategory;
        $productName = $request->productName;
        $orderByPrice = $request->orderByPrice;
        $type = $this->_typeManager->getTypeEntityById($subCategoryId);

        $filter = json_encode(['subCategory' => $subCategoryId, 'productName' => $productName, 'orderByPrice' => $orderByPrice]);
        return view('client.products.products', compact('filter','type'));
    }

    public function showProduct($id){

        $product = $this->_productManager->getProductById($id);
        $type = $product->getType();
        $features = $type->getFeatures();
        $isInCart = false;
        $isInCompare = false;
        $compareAllowed = true;

        if(Session::has('cart')){
            $cart = Session::get('cart');
            $productsIds = new ArrayCollection($cart->getProductsIds());

            if($productsIds->contains(strval($product->getId()))){
                $isInCart = true;
            }
        }

        if(Session::has('compareProducts')){
            $compare = Session::get('compareProducts');
            $compareProductsIds = new ArrayCollection($compare->getProdIds());
            $firstProd = $this->_productManager->getProductById($compare->getProdIds()[0]);

            if ($type->getId() != $firstProd->getType()->getId()) {
                $compareAllowed = false;
            }
            if($compareProductsIds->contains(strval($product->getId()))) {
                $isInCompare = true;
            }
        }

        return view('client.products.show', compact('product', 'features', 'isInCart', 'isInCompare', 'compareAllowed'));
    }

    public function categoryView(Request $request){
        $genericTypeId = $request->categoryId;
        $genericType = $this->_genericTypeManager->getGenericTypeEntityById($genericTypeId);

        return view('client.products.category', ['genericType' => $genericType]);
    }

    public function catalogView(Request $request){
        $genericTypes = $this->_genericTypeManager->getAllGenericTypesInCollection();

        return view('client.products.catalog', ['genericTypes' => $genericTypes]);
    }
}

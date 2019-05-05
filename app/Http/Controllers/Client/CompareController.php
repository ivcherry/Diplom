<?php

namespace App\Http\Controllers\Client;

use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\BusinessLogic\FileManager;
use App\BusinessLogic\ProductManager;
use App\BusinessLogic\TypeManager;
use App\BusinessLogic\FeatureManager;
use App\ViewModels\FeatureViewModel;
use App\Entities\Photo;
use App\Entities\Product;
use App\Entities\CompareProducts;
use Exception;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    private $_productManager;
    private $_featureManager;
    private $_typeManager;

    public function __construct(ProductManager $productManager, FeatureManager $featureManager, TypeManager $typeManager)
    {
        $this->_productManager = $productManager;
        $this->_featureManager = $featureManager;
        $this->_typeManager = $typeManager;
    }

    public function index(Request $request)
    {
        if (Session::has('compareProducts'))
        {
          $item = Session::get('compareProducts');

          $products = new ArrayCollection();

            foreach ($item->getProdIds() as $id) {
              $product = $this->_productManager->getProductById($id);
              $products->add($product);
            }

            $typeId = $products[0]->getType();
            $type = $this->_typeManager->getTypeEntityById($typeId);

            $features = $type->getFeatures();

            return view('client.compare.index', compact('features', 'products'));
        } else {
            return view('client.compare.index', ['products' => null]);
        }

    }

    public function getAddToCompare(Request $request)
    {
        $id = $request->prodId;

        $oldCompare = null;

        if (Session::has('compareProducts')) {
            $oldCompare = Session::get('compareProducts');
            $addedProdId = $oldCompare->getProdIds()[0];
            $addedProduct = $this->_productManager->getProductById($addedProdId);
            $newProduct = $this->_productManager->getProductById($id);
            if ($addedProduct->getType()->getId() == $newProduct->getType()->getId())
            {
                $oldCompare->add($id);
            }
        } else {
            $oldCompare = new CompareProducts(null);
            $oldCompare->add($id);
        }

        Session::put('compareProducts', $oldCompare);

        return $this->jsonSuccessResult(['comparedCount' => $oldCompare->getComparedCount()]);
    }

    public function clearAll(Request $request){
          if(Session::has('compareProducts')){
              Session::remove('compareProducts');
              return $this->jsonSuccessResult(['comparedCount' => 0]);
          } else {
          return $this->jsonFaultResult('Ошибка удаления товара из сравнения');
          }
    }

}

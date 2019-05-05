<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.11.2017
 * Time: 18:22
 */

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\FileManager;
use App\BusinessLogic\ProductManager;
use App\BusinessLogic\TypeManager;
use App\Entities\Photo;
use App\Entities\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    private $_productManager;
    private $_typeManager;
    private $_fileManager;
    private $pathToImagesStorage = 'public/images/products/';

    public function __construct(ProductManager $productManager, TypeManager $typeManager, FileManager $fileManager)
    {
        $this->_productManager = $productManager;
        $this->_typeManager = $typeManager;
        $this->_fileManager = $fileManager;
    }

    public function index(){
        return view('admin.products.index');
    }

    public function productsPhotos(){
        return view('admin.products.photos');
    }

    public function getProductPhotos(Request $request, $id){
        $product = $this->_productManager->getProductById($id);
        $view = view('admin.products._productPhotosPartialView', compact('product'));

        return response($view);
    }

    public function addProductPhotos(Request $request){

        try{
            $productId = $request->productId;
            $files = $request->allFiles();
            foreach ($files as $file){
                $path = $this->_fileManager->saveFileInStorage($this->pathToImagesStorage.$productId, $file);
                $photo = new Photo();
                $photo->setImage($path);
                $this->_productManager->addPhotoToProduct($productId, $photo);
            }

            return $this->jsonSuccessResult();
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }

    }

    public function getAllProducts(Request $request){
        $paginationResult = $this->_productManager->getPaginatedProducts($request->pageSize,$request->page);

        return ['products' => $paginationResult->getData(), 'total' => $paginationResult->getCount()];
    }

    public function getProductById(Request $request, $id){
        $product = $this->_productManager->getProductById($id);
        $view = view('admin.products._productPartialView', compact('product'));

        return response($view);
    }

    public function addProduct(Request $request){
        try{
            $product = new Product();
            $product->setName($request->name);
            $product->setPrice(floatval($request->price));
            $product->setAmount($request->amount);
            $product->setDescription($request->description);
            $product->setProducer($request->producer);

            $this->_productManager->addProduct($product, $request->subCategory);

            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function deleteProduct(Request $request){
        try{

            $this->_productManager->deleteProductById($request->id);

            return $this->jsonSuccessResult();
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function editProduct(Request $request){
        try{

            $product = new Product();
            $product->setId($request->id);
            $product->setName($request->name);
            $product->setPrice(floatval($request->price));
            $product->setAmount($request->amount);
            $product->setDescription($request->description);
            $product->setProducer($request->producer);

            $this->_productManager->editProduct($product, $request->subCategory);
            return $this->jsonSuccessResult();
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function deleteProductPhoto(Request $request){
        try{
            $this->_productManager->deleteProductPhotoById($request->photoId);
            return $this->jsonSuccessResult();
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function productFeatures(){
        return view('admin.products.productFeatures');
    }

    public function getProductFeaturesById(Request $request, $id){
        $product = $this->_productManager->getProductById($id);
        $typeFeatures = $product->getType()->getFeatures()->map(function ($feature){return $feature->jsonSerialize();})->toArray();
        $productFeatures = $product->getFeatures();

        $view = view('admin.products._productFeaturesPartial', compact('product', 'typeFeatures', 'productFeatures'));

        return response($view);
    }

    public function getProductFeature(Request $request){
        try {
            $productFeature = $this->_productManager->getProductFeature($request->productId, $request->featureId);
            if($productFeature){
                $value = $productFeature->getValue();
                return $this->jsonSuccessResult(['value' => empty($value)?"":$value, 'featureId' => $productFeature->getFeature()->getId()]);
            }
            else{
                return $this->jsonSuccessResult(['value' => "", 'featureId' => $request->featureId]);
            }
        }catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function saveFeatureValue(Request $request){
        try{
            $productId = $request->productId;
            $featureId = $request->featureId;
            $value = $request->value;
            $this->_productManager->saveProductFeatureValue($productId, $featureId, $value);

            return $this->jsonSuccessResult(null, "Значение характеристики товара успешно сохранено");
        }
        catch(Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
    }


}
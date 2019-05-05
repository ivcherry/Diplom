<?php

namespace App\BusinessLogic;

use App\Entities\Order;
use App\Entities\PaginationResult;
use App\Entities\Photo;
use App\Entities\Product;
use App\Entities\ProductFeature;
use App\Entities\ProductOrder;
use App\Entities\ProductsFilter;
use App\Entities\Type;
use App\Repositories\UnitOfWork\UnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductManager
{
    private $_unitOfWork;
    private $storagePath = "public/images/products/";

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAll()
    {
        return $this->_unitOfWork->productRepository()->all();
    }

    /**
     * @param $name
     * @return Product
     * @throws Exception
     */
    public function getProductByName($name)
    {
        if (empty($name)) {
            throw new Exception("Ошибка поиска товара. Отсутствует название товара.");
        }
        return $this->_unitOfWork->productRepository()->getByName($name);
    }

    public function getProductById($id)
    {
        if (empty($id)) {
            throw new Exception("Невозможно найти товар, отсуствует идентификатор товара");
        }

        return $this->_unitOfWork->productRepository()->get($id);
    }

    public function addProduct(Product $product, $typeId)
    {
        if (empty($typeId)) {
            throw new Exception("Отсутствует идентификатор подкатегории товара.");
        }
        $type = $this->_unitOfWork->typeRepository()->get($typeId);
        if (!isset($type)) {
            throw new Exception("Отсутствует подкатегория товара с идентификатором" . $typeId);
        }
        $product->setType($type);

        $this->_unitOfWork->productRepository()->create($product);
        $this->_unitOfWork->commit();
    }

    public function getPaginatedProducts($pageSize, $pageNumber)
    {
        $products = new ArrayCollection();
        $paginatedProducts = $this->_unitOfWork->productRepository()->getPaginatedProducts($pageSize, $pageNumber);

        foreach ($paginatedProducts->getData() as $product) {
            $products->add($product->jsonSerialize());
        }
        $paginatedProducts->setData($products->toArray());
        return $paginatedProducts;
    }

    public function deleteProductById($id)
    {
        if (empty($id)) {
            throw new Exception("Невозможно удалить товар. Отсутствует идентификатор товара");
        }
        $product = $this->_unitOfWork->productRepository()->get($id);
        if (!isset($product)) {
            throw new Exception("Товар с идентификатором " . $id . " не найден");
        }

        foreach($product->getPhotos() as $photo){
            $this->deleteProductPhoto($photo);
        }
        Storage::deleteDirectory($this->storagePath.$product->getId());

        $this->_unitOfWork->productFeatureRepository()->deleteByProductId($product->getId());
        $this->_unitOfWork->productRepository()->delete($product);
        $this->_unitOfWork->commit();
    }

    public function editProduct(Product $product, $typeId)
    {
        if (empty($typeId)) {
            throw new Exception("Отсутствует идентификатор подкатегории товара.");
        }
        $type = $this->_unitOfWork->typeRepository()->get($typeId);
        if (!isset($type)) {
            throw new Exception("Отсутствует подкатегория товара с идентификатором" . $typeId);
        }
        $product->setType($type);

        $this->_unitOfWork->productRepository()->update($product);
        $this->_unitOfWork->commit();
    }

    public function addPhotoToProduct($productId, Photo $photo)
    {
        $message = "Невозможно добавить фотографию к товару ";

        if (empty($productId)) {
            throw new Exception($message . "Отсутствует идентификатор товара");
        }
        if (empty($photo)) {
            throw new Exception($message . "Отсуствует фотография товара");
        }
        if (empty($photo->getImage())) {
            throw new Exception($message . "Отсутствует путь к фотографии");
        }

        $product = $this->_unitOfWork->productRepository()->get($productId);

        if (!isset($product)) {
            throw new Exception($message . "Не найден товар с идентфикатором " . $productId);
        }

        $photo->setProduct($product);

        $this->_unitOfWork->photoRepository()->create($photo);
        $this->_unitOfWork->commit();
    }

    public function deleteProductPhotoById($photoId){
        if(empty($photoId)){
            throw new Exception("Невозможно удалить фотографию. Отсутствует идентификатор фотографии.");
        }

        $photo = $this->_unitOfWork->photoRepository()->get($photoId);

        if(!isset($photo)){
            throw new Exception("Невозможно удалить фотографию. Не найдена фотография с идентификатором ".$photoId);
        }
        $this->deleteProductPhoto($photo);

        $this->_unitOfWork->commit();
    }

    private function deleteProductPhoto($photo){
        Storage::delete('public'.$photo->getImage());
        $this->_unitOfWork->photoRepository()->delete($photo);
    }

    public function getProductFeature($productId, $featureId){
        $product = $this->_unitOfWork->productRepository()->get($productId);

        $productFeature = $product->getFeatures()->filter(
            function($item) use($featureId){
                return $item->getFeature()->getId() == $featureId;
            })->first();

        return $productFeature;
    }

    public function saveProductFeatureValue($productId, $featureId, $value){
        $message = "Невозможно сохранить значение характеристики товара";

        if (empty($productId)) {
            throw new Exception($message . "Отсутствует идентификатор товара");
        }
        if (empty($featureId)) {
            throw new Exception($message . "Отсуствует идентификатор характеристики");
        }

        $product = $this->_unitOfWork->productRepository()->get($productId);

        if(!isset($product)){
            throw new Exception($message . "Товар не найден с идентификатором".$productId);
        }

        $feature = $this->_unitOfWork->featureRepository()->get($featureId);
        if(!isset($feature)){
            throw new Exception($message . "Характеристика товара с идентификатором ".$productId." не найдена");
        }

        $productFeatures = $this->_unitOfWork->productFeatureRepository()->getByProductIdAndFeatureId($productId, $featureId);
        if($productFeatures->isEmpty()){
            $productFeature = new ProductFeature();
            $productFeature->setProduct($product);
            $productFeature->setFeature($feature);
            $productFeature->setValue($value);
            $this->_unitOfWork->productFeatureRepository()->create($productFeature);
        }
        else{
            $productFeature = $productFeatures->first();
            $productFeature->setValue($value);
            $this->_unitOfWork->productFeatureRepository()->update($productFeature);
        }

        $this->_unitOfWork->commit();
    }

    public function getPaginatedProductsWithFilter(ProductsFilter $filter, $pageSize, $pageNumber){
        $products = new ArrayCollection();
        $paginatedProducts = $this->_unitOfWork->productRepository()->getPaginatedProductsWithFilter($filter, $pageSize, $pageNumber);

        foreach ($paginatedProducts->getData() as $product) {
            $products->add($product->jsonSerialize());
        }
        $paginatedProducts->setData($products->toArray());
        return $paginatedProducts;
    }

    public function checkOrderProducts($productsInfo){
        $summaryPrice = 0.0;

        if(empty($productsInfo)){
            throw new Exception('Отсутствуют товары в корзине.');
        }

        foreach($productsInfo as $productInfo){
            $productId = $productInfo->productId;
            $productAmount = $productInfo->productAmount;

            $product = $this->_unitOfWork->productRepository()->get($productId);
            if(!isset($product)){
                throw new Exception("Товар с идентификатором $product отсутствует");
            }

            if($product->getAmount() < $productAmount){
                throw new Exception("Товар".$product->getName()." в количестве".$productAmount."отсутствует на складе.");
            }

            $summaryPrice += $productAmount*$product->getPrice();
        }

        return $summaryPrice;
    }

    public function saveOrder($productsInfo)
    {
        date_default_timezone_set('Europe/Moscow');
        $currentUser = Auth::user();
        if ($currentUser == null) {
            throw new Exception("Для оформления заказа необходимо зарегистрироваться");
        }
        $summaryPrice = 0.0;
        $order = new Order();
        $order->setDateOfOrder(date_create());
        $order->setUser($currentUser);
        try {
            if (empty($productsInfo)) {
                throw new Exception('Отсутствуют товары в корзине.');
            }

            $this->_unitOfWork->orderRepository()->create($order);
            $this->_unitOfWork->commit();
            foreach ($productsInfo as $productInfo) {
                $currentProduct = $this->_unitOfWork->productRepository()->get($productInfo->productId);
                if (!isset($currentProduct)) {
                    throw new Exception("Товар с идентификатором.".$productInfo->productId."отсутствует");
                }
                $currentProductAmount = $currentProduct->getAmount();
                if ($currentProductAmount < $productInfo->productAmount) {
                    throw new Exception("Товар" . $currentProduct->getName() . " в количестве" . $productInfo->productAmount . "отсутствует на складе.");
                }
                $currentProduct->setAmount($currentProductAmount - $productInfo->productAmount);
                $this->_unitOfWork->productRepository()->update($currentProduct);

                $productOrder = new ProductOrder();
                $productOrder->setProduct($currentProduct);
                $productOrder->setAmount($productInfo->productAmount);
                $currentProductPrice = $productInfo->productAmount * $currentProduct->getPrice();
                $productOrder->setPrice($currentProductPrice);
                $summaryPrice += $currentProductPrice;
                $productOrder->setOrder($order);
                $this->_unitOfWork->productOrderRepository()->create($productOrder);
            }
            $order->setTotalPrice($summaryPrice);
            $this->_unitOfWork->orderRepository()->update($order);
            $this->_unitOfWork->commit();
        }
        catch (Exception $e) {
            $this->_unitOfWork->orderRepository()->delete($order);
            $this->_unitOfWork->commit();
            throw new Exception($e->getMessage());
        }
    }


    public function test(){
        dd($this->getPaginatedProductsByEquipmentProfile(2,2, 10, 1));
        $compatibilities = array(['feature' => '15', 'value' => 'AMD-4', 'rule' => '=']);
        $compatibilities = new ArrayCollection($this->_unitOfWork->productRepository()->getPaginatedProductsByCompatibilityInfo(2, $compatibilities));

    }

    public function getPaginatedProductsByEquipmentProfile($productId, $secondTypeId, $pageSize, $pageNumber){
        $paginatedResult = new PaginationResult([], 0);

        $product = $this->_unitOfWork->productRepository()->get($productId);
        if(!isset($product)){
            throw new Exception("Ошибка бизнес логики. Товар с идентификатором $productId отсутствует");
        }

        $firstTypeId = $product->getType()->getId();
        $productFeatures = $product->getFeatures();

        $compatibilities = $this->_unitOfWork->compatibilityRepo()->getCompatibilitiesByTypesIds($firstTypeId, $secondTypeId);
        if(!$compatibilities->isEmpty() ){
            if(!$productFeatures->isEmpty()){
                $compatibilitiesInfo = $compatibilities->map(function ($item) use ($firstTypeId, $productFeatures) {
                    if ($item->getFirstType()->getId() == $firstTypeId) {
                        $productFeatureValue = $productFeatures->filter(function ($productFeature) use ($item) {
                            return $productFeature->getFeature() == $item->getFirstFeature();
                        })
                            ->first()
                            ->getValue();
                        return [
                            'feature' => $item->getSecondFeature()->getId(),
                            'value' => $productFeatureValue,
                            'rule' => $item->getRule()
                        ];
                    }
                });
                if(!empty($compatibilitiesInfo)) {
                    $paginatedResult = $this->_unitOfWork->productRepository()->getPaginatedProductsByCompatibilityInfo($secondTypeId, $compatibilitiesInfo, $pageSize, $pageNumber);
                }
            }

        }
        else{
            $filter = new ProductsFilter();
            $filter->setTypeId($secondTypeId);

            $paginatedResult = $this->_unitOfWork->productRepository()->getPaginatedProductsWithFilter($filter,$pageSize, $pageNumber);
        }
        $products = new ArrayCollection();

        foreach ($paginatedResult->getData() as $product) {
            $products->add($product->jsonSerialize());
        }
        $paginatedResult->setData($products->toArray());
        return $paginatedResult;
    }
}


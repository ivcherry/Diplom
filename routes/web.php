<?php

use App\Entities\UserRoles;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return redirect()->route('home');
});
/*
Route::get('/home', function()
{
    return view('home');
});
*/
Route::name('home')->get('/home', 'Client\HomeController@index');

Route::post('/addToCompare','Client\CompareController@getAddToCompare');
Route::get('/deleteComparedProduct', 'Client\CompareController@clearAll');

Route::get('/product','ProductController@getProduct');

Route::get('/auth/register','Auth\RegisterController@index');
Route::post('/auth/register','Auth\RegisterController@register');

Route::group(['prefix' => 'admin', 'middleware' => 'checkUserRole:'.UserRoles::Admin], function (){
    Route::get('/','Admin\TypeController@index');

    Route::get('/sales','Admin\SaleController@index');
    Route::get('/sales/getSale/{id}','Admin\SaleController@getSaleById');
    Route::get('/sales/getPaginate','Admin\SaleController@getPaginate');
    Route::post('/sales/edit', 'Admin\SaleController@edit');
    Route::post('/sales/delete','Admin\SaleController@delete');
    Route::post('/sales/add','Admin\SaleController@add');

    Route::get('/news','Admin\NewsController@index');
    Route::get('/news/getNews/{id}','Admin\NewsController@getNewsById');
    Route::get('/news/getPaginate','Admin\NewsController@getPaginate');
    Route::post('/news/edit', 'Admin\NewsController@edit');
    Route::post('/news/delete','Admin\NewsController@delete');
    Route::post('/news/add','Admin\NewsController@add');

    Route::get('/orders','Admin\OrderController@index');
    Route::get('/orders/getOrder/{id}','Admin\OrderController@getOrderById');
    Route::get('/orders/getPaginate','Admin\OrderController@getPaginate');

    Route::get('/subCategories','Admin\TypeController@index');
    Route::get('/getPaginatedSubCategories','Admin\TypeController@getPaginatedTypes');
    Route::get('/subCategories/getSubCategories/{id}', 'Admin\TypeController@getTypeById');
    Route::get('/subCategories/getAllSubCategories','Admin\TypeController@getAllTypes');
    Route::post('/subCategories/editSubCategory', 'Admin\TypeController@editType');
    Route::post('/subCategories/deleteSubCategory','Admin\TypeController@deleteSubCategory');
    Route::post('/subCategories/addSubCategory','Admin\TypeController@addType');
    Route::get('/categories','Admin\GenericTypeController@index');
    Route::get('/getPaginatedGenericTypes','Admin\GenericTypeController@getPaginatedGenericTypes');
    Route::get('/categories/getCategories/{id}','Admin\GenericTypeController@getGenericTypeById');
    Route::post('/categories/addCategory','Admin\GenericTypeController@addGenericType');
    Route::post('/categories/deleteCategory','Admin\GenericTypeController@deleteGenericType');
    Route::post('/categories/editCategory', 'Admin\GenericTypeController@editGenericType');
    Route::get('/getAllCategories', 'Admin\GenericTypeController@getAllGenericTypes');
    Route::get('/products','Admin\ProductController@index');
    Route::get('/products/getAllProducts','Admin\ProductController@getAllProducts');
    Route::get('/products/getProduct/{id}', 'Admin\ProductController@getProductById');
    Route::post('/products/addProduct' , 'Admin\ProductController@addProduct');
    Route::get('/products/photos','Admin\ProductController@productsPhotos');
    Route::get('/products/getProductPhotos/{id}', 'Admin\ProductController@getProductPhotos');
    Route::post('/products/addProductPhotos', 'Admin\ProductController@addProductPhotos');
    Route::post('/products/deleteProduct', 'Admin\ProductController@deleteProduct');
    Route::post('/products/editProduct', 'Admin\ProductController@editProduct');
    Route::post('/products/deleteProductPhoto', 'Admin\ProductController@deleteProductPhoto');
    Route::get('/subCategories/features', 'Admin\TypeController@subCategoriesFeatures');
    Route::get('/subCategories/getSubCategoryFeatures/{id}', 'Admin\TypeController@getSubCategoryFeatures');
    Route::post('/subCategories/addFeatureToSubCategory', 'Admin\TypeController@addFeature');
    Route::post('/subCategories/deleteFeature', 'Admin\TypeController@deleteFeature');
    Route::get('/products/features', 'Admin\ProductController@productFeatures');
    Route::get('/products/getProductFeatures/{id}', 'Admin\ProductController@getProductFeaturesById');
    Route::post('/products/getProductFeature', 'Admin\ProductController@getProductFeature');
    Route::post('/products/saveFeatureValue', 'Admin\ProductController@saveFeatureValue');

    Route::get('/companyHistory', 'Admin\CompanyHistoryController@index');
    Route::post('/companyHistory/saveContent','Admin\CompanyHistoryController@saveHistoryContent');

    Route::get('/contacts', 'Admin\ContactsController@index');
    Route::post('/contacts/saveContent','Admin\ContactsController@saveContactsContent');

    Route::get('/technicalSupport', 'Admin\TechnicalSupportController@index');
    Route::post('/technicalSupport/saveContent','Admin\TechnicalSupportController@saveTechnicalSupportContent');

    Route::get('/howToFindUs', 'Admin\HowToFindUsController@index');
    Route::post('/howToFindUs/saveContent','Admin\HowToFindUsController@saveHowToFindUsContent');
    Route::get('/compatibilities', 'Admin\CompatibilityController@index');
    Route::get('compatibilities/getPaginatedCompatibilities', 'Admin\CompatibilityController@getPaginatedCompatibilities');
    Route::get('compatibilities/getCompatibility/{id}', 'Admin\CompatibilityController@getCompatibilityById');
    Route::post('/compatibilities/deleteCompatibility', 'Admin\CompatibilityController@deleteCompatibility');
    Route::post('compatibility/addCompatibility', 'Admin\CompatibilityController@addCompatibility');
});


Route::get('/admin/features','Admin\FeatureController@index')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/features/getFeatures/{id}','Admin\FeatureController@getFeatureById')->middleware('checkUserRole:'.UserRoles::Admin);
Route::post('/admin/features/addFeature','Admin\FeatureController@addFeature')->middleware('checkUserRole:'.UserRoles::Admin);
Route::post('/admin/features/deleteFeature','Admin\FeatureController@deleteFeature')->middleware('checkUserRole:'.UserRoles::Admin);
Route::post('/admin/features/editFeature', 'Admin\FeatureController@editFeature')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/getAllFeatures', 'Admin\FeatureController@getAllFeatures')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/features/getPaginatedFeatures', 'Admin\FeatureController@getPaginatedFeatures')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/getFeaturesByTypeId/{typeId}', 'Admin\FeatureController@getFeaturesByTypeId')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/user_data','Admin\UserController@index')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/user_data/getUser/{id}','Admin\UserController@getUserById')->middleware('checkUserRole:'.UserRoles::Admin);
Route::post('/admin/user_data/deleteUser','Admin\UserController@deleteUser')->middleware('checkUserRole:'.UserRoles::Admin);
Route::post('/admin/user_data/editUser', 'Admin\UserController@editUserRole')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/getAllUsers', 'Admin\UserController@getAllUsers')->middleware('checkUserRole:'.UserRoles::Admin);
Route::get('/admin/user_data/getPaginatedUsers', 'Admin\UserController@getPaginatedUsers')->middleware('checkUserRole:'.UserRoles::Admin);

Route::name('companyHistory')->get('/companyHistory', 'Client\CompanyHistoryController@index');
Route::get('/companyHistory/getContent', 'Client\CompanyHistoryController@getzContent');

Route::get('/category/{id}/subCategory/{sId}', 'ProductController@test');
Route::get('/products/getAllProducts', 'Client\ProductsController@getAllProducts');
Route::name('products')->get('/products','Client\ProductsController@index');
Route::get('/product/{id}','Client\ProductsController@showProduct');
Route::name('category')->get('/category','Client\ProductsController@categoryView');
Route::name('subCategory')->get('/subCategory','Client\HomeController@index');
Route::name('catalog')->get('/catalog', 'Client\ProductsController@catalogView');
Route::name('shoppingCart')->get('shoppingCart', 'Client\OrderController@index');
Route::post('/shoppingCart/addToCart', 'Client\OrderController@addToCart');
Route::post('/shoppingCart/checkAndUpdateProductInfo', 'Client\OrderController@checkAndUpdateProductInfo');
Route::post('/shoppingCart/deleteProduct', 'Client\OrderController@deleteProduct');
Route::post('/shoppingCart/checkout', 'Client\OrderController@checkout');

Route::name('compare')->get('compare', 'Client\CompareController@index');

Route::name('contacts')->get('/contacts', 'Client\ContactsController@index');
Route::get('/contacts/getContent', 'Client\ContactsController@getContent');

Route::name('technicalSupport')->get('/technicalSupport', 'Client\TechnicalSupportController@index');
Route::get('/technicalSupport/getContent', 'Client\TechnicalSupportController@getContent');

Route::name('howToFindUs')->get('/howToFindUs', 'Client\HowToFindUsController@index');
Route::get('/howToFindUs/getContent', 'Client\HowToFindUsController@getContent');

Route::name('order')->get('order', 'Client\OrderController@mainOrder');
Route::post('/order/submitOrder', 'Client\OrderController@saveOrder');
Route::name('thanksForPurchase')->get('thanksForPurchase', 'Client\OrderController@thanksForPurchase');

Route::get('/workSchedules','Client\WorkScheduleController@getAllWorkScheduler');
Route::post('/workSchedules/{id}/updateState','Client\WorkScheduleController@updateState');

Route::get('/install','Client\InstallController@index');
Route::get('/tuning','Client\TuningController@index');
Route::post('/thanksForOrdering','Client\InstallController@thanksPage');

Route::name('equipment')->get('/equipment', 'Client\EquipmentController@currentEquipmentStage');
Route::get('/equipment/getProductsByEquipmentStage', 'Client\EquipmentController@getPaginatedProductsByEquipmentStage');
Route::post('/equipment/addToEquipment', 'Client\EquipmentController@addProductToEquipment');
Route::post('/equipment/checkout', 'Client\EquipmentController@checkoutEquipment');
Route::get('/equipment/reset', 'Client\EquipmentController@resetEquipment');


Route::get('/workSchedules','Client\WorkScheduleController@getAllWorkScheduler');
Route::post('/workSchedules/{id}/updateState','Client\WorkScheduleController@updateState');

Route::get('/install','Client\InstallController@index');
Route::get('/tuning','Client\TuningController@index');
Route::post('/thanksForOrdering','Client\InstallController@thanksPage');

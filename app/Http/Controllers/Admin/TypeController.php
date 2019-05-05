<?php
/**
 * Created by PhpStorm.
 * User: EvgeniySharipov
 * Date: 06.11.2017
 * Time: 22:45
 */

namespace App\Http\Controllers\Admin;
use App\Entities\Type;
use App\Http\Controllers\Controller;
use App\BusinessLogic\TypeManager;
use Illuminate\Http\Request;
use App\ViewModels\TypeViewModel;
use Exception;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    private $_typeManager;

    public function __construct(TypeManager $typeManager)
    {
        $this->_typeManager = $typeManager;
    }

    public function index(){
        return view('admin.subCategories.subCategory');
    }

    public function getAllTypes(){
        $types = $this->_typeManager->getAllTypes();

        return $types;
    }

    public function getPaginatedTypes(Request $request)
    {
        $paginationTypes = $this->_typeManager->getPaginatedTypes($request->pageSize, $request->page);

        return ['types' =>$paginationTypes->getData(), 'total' => $paginationTypes->getCount()];
    }

    public function getTypeById(Request $request, $id)
    {
        $typeModel = $this->_typeManager->getTypeById($id);
        $view = view('admin.subCategories._subCategoryPartialView', compact('typeModel'));
        return response($view);
    }

    public function editType(Request $request)
    {
        try {
            $typeViewModel = new TypeViewModel();
            $typeViewModel->setName($request->name);
            $typeViewModel->setId($request->id);
            $typeViewModel->setGenericTypeId($request->category);

            $this->_typeManager->editType($typeViewModel);

            return $this->jsonSuccessResult(null);
        }
        catch(\Exception $e){
            return $this->jsonFaultResult($e->getMessage());
        }
  }

  public function deleteSubCategory(Request $request)
  {
      try{
          $typeId = $request->id;
          $this->_typeManager->deleteType($typeId);
          return $this->jsonSuccessResult(null);
      }
      catch(Exception $e){
          return $this->jsonFaultResult([$e->getMessage()]);
      }
  }

  public function addType(Request $request)
  {

     try {
         $validator = Validator::make($request->all(),
             [
                 'name' => 'required|string|'
             ],
             [
                 'name.required' => 'Поле "Наименование" должно быть заполнено.'
             ]);
         if ($validator->passes()) {
             $type = new TypeViewModel();
             $type->setName($request->name);
             $type->setGenericTypeId($request->category);
             $this->_typeManager->addType($type);
             return $this->jsonSuccessResult(null);
         }
         return $this->jsonFaultResult($validator->errors()->all());
     }
     catch (Exception $e)
     {
        return $this->jsonFaultResult([$e->getMessage()]);
     }
  }

  public function subCategoriesFeatures(){
        return view('admin.subCategories.subCategoriesFeatures');
  }

  public function getSubCategoryFeatures(Request $request, $id){

      $type = $this->_typeManager->getTypeFeatures($id);

      $view = view('admin.subCategories._subCategoryFeaturesPartial', compact('type'));

      return response($view);
  }

  public function addFeature(Request $request){
      try{
          $typeId = $request->typeId;
          $featureId = $request->featureId;

          $this->_typeManager->addFeatureToType($typeId, $featureId);

          return $this->jsonSuccessResult( null, "Характерстика успешно добавлена");
      }
      catch(Exception $e){
          return $this->jsonFaultResult($e->getMessage());
      }

  }

  public function deleteFeature(Request $request){
      try{
            $typeId = $request->typeId;
            $featureId = $request->featureId;
            $this->_typeManager->deleteTypeFeature($typeId, $featureId);

            return $this->jsonSuccessResult( null, "Характерстика успешно удалена");
      }
      catch (Exception $e){
          return $this->jsonFaultResult($e->getMessage());
      }
  }

}
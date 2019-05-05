<?php

namespace App\Http\Controllers;

use App\BusinessLogic\ProductManager;
use App\BusinessLogic\GenericTypeManager;
use App\BusinessLogic\TypeManager;
use App\Entities\Type;
use App\Entities\GenericType;
use App\Entities\Product;
use Doctrine\Common\Collections\Criteria;
use App\BusinessLogic\UserManager;
use App\BusinessLogic\FeatureManager;
use Session;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $_productManager;
    private $_genericTypeManager;
    private $_typeManager;
    private $_userManager;
    private $_featureManager;

    public function __construct(UserManager $userManager,ProductManager $productManager, GenericTypeManager $genericTypeManager, TypeManager $typeManager, FeatureManager $featureManager)
    {
        $this->_productManager = $productManager;
        $this->_genericTypeManager = $genericTypeManager;
        $this->_typeManager = $typeManager;
        $this->_userManager =$userManager;
        $this->_featureManager =$featureManager;
    }

    public function getProduct()
    {
        try
        {
            $this->_productManager->test();
          return view('product', ['price' => "23"]);
        }
        catch (Exception $ex)
        {

            return view('product', ['price' => $ex->getMessage()]);
        }
    }

    public function test(Request $request, $id, $sId){

        dd($id, $sId);
    }
}

<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\BusinessLogic\GenericTypeManager;

class ClientComposer
{

    protected $genericTypeManager;

    public function __construct(GenericTypeManager $genericTypeManager)
    {
        $this->genericTypeManager = $genericTypeManager;
    }


    public function compose(View $view)
    {
        $view->with('genericTypes', $this->genericTypeManager->getAllGenericTypesInCollection());
    }
}
<?php

namespace App\Http\ViewComposers;

use App\BusinessLogic\GenericTypeManager;
use Illuminate\View\View;

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
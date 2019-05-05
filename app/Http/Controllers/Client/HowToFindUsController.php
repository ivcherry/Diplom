<?php

namespace App\Http\Controllers\Client;

use App\BusinessLogic\PageContentManager;
use App\Entities\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HowToFindUsController extends Controller{

    private $_pageContentManager;
    private $howToFindUsPageName = "howToFindUs";

    public function __construct(PageContentManager $pageContentManager)
    {
        $this->_pageContentManager = $pageContentManager;
    }

    public function index(){

        return view('client.contact.howToFindUs',['lalka' => ['1','2']]);
    }

    public function getContent(Request $request){
        $pageContent = $this->_pageContentManager->getPageContentByPageName($this->howToFindUsPageName);
        return htmlspecialchars_decode($pageContent->getContent());
    }
}

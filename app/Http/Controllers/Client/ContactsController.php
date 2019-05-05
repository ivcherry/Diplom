<?php

namespace App\Http\Controllers\Client;

use App\BusinessLogic\PageContentManager;
use App\Entities\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller{

    private $_pageContentManager;
    private $contactPageName = "contactInfo";

    public function __construct(PageContentManager $pageContentManager)
    {
        $this->_pageContentManager = $pageContentManager;
    }

    public function index(){

        return view('client.contact.contacts',['lalka' => ['1','2']]);
    }

    public function getContent(Request $request){
        $pageContent = $this->_pageContentManager->getPageContentByPageName($this->contactPageName);
        return htmlspecialchars_decode($pageContent->getContent());
    }
}

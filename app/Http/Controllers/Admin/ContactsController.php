<?php

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\PageContentManager;
use App\Entities\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class ContactsController extends Controller{
    private $_pageContentManager;
    private $contactPageName = "contactInfo";

    public function __construct(PageContentManager $pageContentManager)
    {
        $this->_pageContentManager = $pageContentManager;
    }

    public function index(){
        $pageContent = $this->_pageContentManager->getPageContentByPageName($this->contactPageName);
        return view('admin.contact.contacts', ['content' => htmlspecialchars_decode($pageContent->getContent())]);
    }

    public function saveContactsContent(Request $request){
      try{
          $content = $request->contactsContent;
          $content = htmlspecialchars($content, ENT_QUOTES);

          $pageContent = new PageContent();
          $pageContent->setPageName($this->contactPageName);
          $pageContent->setContent($content);

          $this->_pageContentManager->savePageContent($pageContent);
          return $this->jsonSuccessResult(null, "Содержание страницы 'Контакты' успешно сохранена");
      }
      catch (Exception $e){
          return $this->jsonSuccessResult($e->getMessage());
      }
    }
}

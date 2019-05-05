<?php

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\PageContentManager;
use App\Entities\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class HowToFindUsController extends Controller{
    private $_pageContentManager;
    private $howToFindUsPageName = "howToFindUs";

    public function __construct(PageContentManager $pageContentManager)
    {
        $this->_pageContentManager = $pageContentManager;
    }

    public function index(){
        $pageContent = $this->_pageContentManager->getPageContentByPageName($this->howToFindUsPageName);
        return view('admin.contact.howToFindUs', ['content' => htmlspecialchars_decode($pageContent->getContent())]);
    }

    public function saveHowToFindUsContent(Request $request){
      try{
          $content = $request->howToFindUsContent;
          $content = htmlspecialchars($content, ENT_QUOTES);

          $pageContent = new PageContent();
          $pageContent->setPageName($this->howToFindUsPageName);
          $pageContent->setContent($content);

          $this->_pageContentManager->savePageContent($pageContent);
          return $this->jsonSuccessResult(null, "Содержание страницы 'Как нас найти' успешно сохранена");
      }
      catch (Exception $e){
          return $this->jsonSuccessResult($e->getMessage());
      }
    }
}

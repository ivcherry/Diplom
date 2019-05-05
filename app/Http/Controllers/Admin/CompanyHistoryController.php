<?php

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\PageContentManager;
use App\Entities\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class CompanyHistoryController extends Controller{
    private $_pageContentManager;
    private $historyPageName = "companyHistory";

    public function __construct(PageContentManager $pageContentManager)
    {
        $this->_pageContentManager = $pageContentManager;
    }

    public function index(){
        $pageContent = $this->_pageContentManager->getPageContentByPageName($this->historyPageName);
        return view('admin.companyHistory.companyHistoryView', ['content' => htmlspecialchars_decode($pageContent->getContent())]);
    }

    public function saveHistoryContent(Request $request){
      try{
          $content = $request->historyContent;
          $content = htmlspecialchars($content, ENT_QUOTES);

          $pageContent = new PageContent();
          $pageContent->setPageName($this->historyPageName);
          $pageContent->setContent($content);

          $this->_pageContentManager->savePageContent($pageContent);
          return $this->jsonSuccessResult(null, "Содержание страницы 'История компании' успешно сохранена");
      }
      catch (Exception $e){
          return $this->jsonSuccessResult($e->getMessage());
      }
    }
}
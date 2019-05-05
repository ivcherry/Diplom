<?php

namespace App\Http\Controllers\Client;

use App\BusinessLogic\PageContentManager;
use App\Entities\PageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyHistoryController extends Controller{

    private $_pageContentManager;
    private $historyPageName = 'companyHistory';

    public function __construct(PageContentManager $pageContentManager)
    {
        $this->_pageContentManager = $pageContentManager;
    }

    public function index(){

        return view('client.companyHistory.companyHistoryView');
    }

    public function getContent(Request $request){
        $pageContent = $this->_pageContentManager->getPageContentByPageName($this->historyPageName);
        return htmlspecialchars_decode($pageContent->getContent());
    }
}

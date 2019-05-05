<?php

namespace App\BusinessLogic;

use App\Repositories\UnitOfWork\UnitOfWork;
use Exception;
use App\Entities\PageContent;

class PageContentManager{

    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getPageContentByPageName($pageName){
        if(empty($pageName)) {
            throw new Exception("Невозможно найти контент страницы. Не указан псевдоним страницы.");
        }
        return $this->_unitOfWork->pageContentRepository()->getByPageName($pageName);
    }

    public function savePageContent(PageContent $pageContent){
        if(empty($pageContent)){
            throw new Exception("Ошибка сохранения контента страницы.");
        }

        $entity = $this->_unitOfWork->pageContentRepository()->getByPageName($pageContent->getPageName());

        $entity->setContent($pageContent->getContent());

        $this->_unitOfWork->pageContentRepository()->update($entity);
        $this->_unitOfWork->commit();
    }
}
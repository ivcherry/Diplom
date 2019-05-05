<?php

namespace App\BusinessLogic;

use App\Entities\News;
use App\Repositories\UnitOfWork\UnitOfWork;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Exception;

class NewsManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getAll()
    {
        return $this->_unitOfWork->newsRepository()->all();
    }

    public function getNewsByTitle($title)
    {
        if (!empty($title)) {
            return $this->_unitOfWork->newsRepository()->where("news.title like %$title%");
        }
    }

    public function getNewsById($id)
    {
        return $this->_unitOfWork->newsRepository()->get($id);
    }

    public function addNews(News $news)
    {
        try {
            $this->_unitOfWork->newsRepository()->create($news);
            $this->_unitOfWork->commit();
        }
        catch (Exception $exception){
            $name = $news->getTitle();
            throw new Exception("Категория с наименованием $name уже существует");
        }
    }

    public function getPaginate($pageSize, $pageNumber)
    {
        $arrayNews = new ArrayCollection();
        $paginatedTypes = $this->_unitOfWork->newsRepository()->getPaginate($pageSize, $pageNumber);
        foreach ($paginatedTypes->getData() as $news) {
            $newsSerialize = new News();
            $newsSerialize->fillFromNewsEntity($news);
            $newsSerialize->jsonSerialize();
            $arrayNews->add($newsSerialize);
        }
        $paginatedTypes->setData($arrayNews->toArray());
        return $paginatedTypes;
    }

    public function edit(News $news){
        if(empty($news->getId())){
            throw new Exception("Невозможно изменить новость. Не указан идентификатор");
        }
        if(empty($news->getTitle())){
            throw new Exception("Невозможно изменить новость. Не указан заголовок");
        }
        if(empty($news->getSummary())){
            throw new Exception("Невозможно изменить новость. Не указано краткое содержание");
        }
        if(empty($news->getText())){
            throw new Exception("Невозможно изменить новость. Не указан текст");
        }
        if(empty($news->getDate())){
            throw new Exception("Невозможно изменить новость. Не указана дата");
        }
        $this->_unitOfWork->newsRepository()->update($news);
        $this->_unitOfWork->commit();
    }

    public function delete($id){
        if(empty($id)){
            throw new Exception("Невозможно удалить категрию товара. Отсуствует идентификатор категории товара.");
        }

        $news = $this->_unitOfWork->newsRepository()->get($id);
        if(!isset($news)){
            throw new Exception("Невозможно удалить категорию товара. Категория товара с идентификатором $id не найден.");
        }
        $this->_unitOfWork->newsRepository()->delete($news);
        $this->_unitOfWork->commit();
    }

}


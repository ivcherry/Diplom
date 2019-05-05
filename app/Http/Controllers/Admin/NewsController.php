<?php
/**
 * Created by PhpStorm.
 * User: EvgeniySharipov
 * Date: 06.11.2017
 * Time: 22:45
 */

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\NewsManager;
use App\Entities\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    private $_newsManager;

    public function __construct(NewsManager $newsManager)
    {
        $this->_newsManager = $newsManager;
    }

    public function getPaginate(Request $request)
    {
        $paginatedNews = $this->_newsManager->getPaginate($request->pageSize, $request->page);

        return ['news' => $paginatedNews->getData(), 'total' => $paginatedNews->getCount()];
    }

    public function index()
    {
        return view('admin.news.index');
    }

    public function getAllNews(Request $request)
    {

        $paginationTypes = $this->_newsManager->getPaginate($request->pageSize, $request->page);

        return ['news' => $paginationTypes->getData(), 'total' => $paginationTypes->getCount()];
    }

    public function getNewsById(Request $request, $id)
    {
        $newsModel = $this->_newsManager->getNewsById($id);
        $view = view('admin.news._newsPartialView', compact('newsModel'));
        return response($view);
    }

    public function edit(Request $request)
    {
        try {
            $newsModel = new News();
            $newsModel->setTitle($request->title);
            $newsModel->setId($request->id);
            $newsModel->setSummary($request->summary);
            $newsModel->setText($request->text);
            $newsModel->setDate($request->date);

            $this->_newsManager->edit($newsModel);

            return $this->jsonSuccessResult(null);
        } catch (\Exception $e) {
            return $this->jsonFaultResult($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $typeId = $request->id;
            $this->_newsManager->delete($typeId);
            return $this->jsonSuccessResult(null);
        } catch (Exception $e) {
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function add(Request $request)
    {

        try {
            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|string|'
                ],
                [
                    'title.required' => 'Поле "Наименование" должно быть заполнено.'
                ]);
            if ($validator->passes()) {
                $newsModel = new News();
                $newsModel->setTitle($request->title);
                $newsModel->setId($request->id);
                $newsModel->setSummary($request->summary);
                $newsModel->setText($request->text);
                $newsModel->setDate($request->date);
                $this->_newsManager->addNews($newsModel);
                return $this->jsonSuccessResult(null);
            }
            return $this->jsonFaultResult($validator->errors()->all());
        } catch (Exception $e) {
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }
}
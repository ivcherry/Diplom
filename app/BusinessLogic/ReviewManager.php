<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:51
 */

namespace App\BusinessLogic;
use App\Repositories\UnitOfWork\UnitOfWork;

class ReviewManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function getReviewById($id){
        return $this->_unitOfWork->reviewRepository()->get($id);
    }
}
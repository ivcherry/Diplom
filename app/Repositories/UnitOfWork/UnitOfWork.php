<?php

namespace App\Repositories\UnitOfWork;


use App\Repositories\CompatibilityRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PageContentRepository;
use App\Repositories\SaleRepository;
use Doctrine\ORM\EntityManager;
use App\Repositories\ProductRepository;
use App\Repositories\TypeRepository;
use App\Repositories\GenericTypeRepository;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\ProductFeatureRepository;
use App\Repositories\FeatureRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductOrderRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\WorkSchedulerRepository;

class UnitOfWork
{
    private $_em;

    public function __construct(EntityManager $em)
    {
        $this->_em = $em;
    }

    private $_productRepo;
    private $_typeRepo;
    private $_genericTypeRepo;
    private $_userRepo;
    private $_roleRepo;
    private $_reviewRepo;
    private $_photoRepo;
    private $_productFeatureRepo;
    private $_featureRepo;
    private $_productOrderRepo;
    private $_orderRepo;
    private $_newsRepo;
    private $_saleRepo;
    private $_pageContentRepo;
    private $_scheduleRepo;
    private $_workSchedulerRepo;
    private $_compatibilityRepo;

    public function compatibilityRepo(){
        if ($this->_compatibilityRepo == null) {
            $this->_compatibilityRepo = new CompatibilityRepository($this->_em);
        }
        return $this->_compatibilityRepo;
    }

    public function reviewRepository()
    {
        if ($this->_reviewRepo == null) {
            $this->_reviewRepo = new ReviewRepository($this->_em);
        }
        return $this->_reviewRepo;
    }
    public function workSchedulerRepository()
    {
        if ($this->_workSchedulerRepo == null) {
            $this->_workSchedulerRepo = new WorkSchedulerRepository($this->_em);
        }
        return $this->_workSchedulerRepo;
    }

    public function scheduleRepository()
    {
        if ($this->_scheduleRepo == null) {
            $this->_scheduleRepo = new ScheduleRepository($this->_em);
        }
        return $this->_scheduleRepo;
    }

    public function newsRepository()
    {
        if ($this->_newsRepo == null) {
            $this->_newsRepo = new NewsRepository($this->_em);
        }
        return $this->_newsRepo;
    }
    public function saleRepository()
    {
        if ($this->_saleRepo == null) {
            $this->_saleRepo = new SaleRepository($this->_em);
        }
        return $this->_saleRepo;
    }

    public function featureRepository()
    {
        if ($this->_featureRepo == null) {
            $this->_featureRepo = new FeatureRepository($this->_em);
        }
        return $this->_featureRepo;
    }
    public function orderRepository()
    {
        if ($this->_orderRepo == null) {
            $this->_orderRepo = new OrderRepository($this->_em);
        }
        return $this->_orderRepo;
    }

    public function productFeatureRepository()
    {
        if ($this->_productFeatureRepo == null) {
            $this->_productFeatureRepo = new ProductFeatureRepository($this->_em);
        }
        return $this->_productFeatureRepo;
    }
    public function productOrderRepository()
    {
        if ($this->_productOrderRepo == null) {
            $this->_productOrderRepo = new ProductOrderRepository($this->_em);
        }
        return $this->_productOrderRepo;
    }

    public function photoRepository()
    {
        if ($this->_photoRepo == null) {
            $this->_photoRepo = new PhotoRepository($this->_em);
        }

        return $this->_photoRepo;
    }

    public function roleRepository()
    {
        if ($this->_roleRepo == null) {
            $this->_roleRepo = new RoleRepository($this->_em);
        }
        return $this->_roleRepo;
    }

    public function userRepository()
    {
        if ($this->_userRepo == null) {
            $this->_userRepo = new UserRepository($this->_em);
        }
        return $this->_userRepo;
    }

    public function productRepository()
    {
        if ($this->_productRepo == null) {
            $this->_productRepo = new ProductRepository($this->_em);
        }
        return $this->_productRepo;
    }

    public function typeRepository()
    {
        if ($this->_typeRepo == null) {
            $this->_typeRepo = new TypeRepository($this->_em);
        }
        return $this->_typeRepo;
    }

    public function genericTypeRepository()
    {
        if ($this->_genericTypeRepo == null) {
            $this->_genericTypeRepo = new GenericTypeRepository($this->_em);
        }
        return $this->_genericTypeRepo;
    }

    public function pageContentRepository(){
        if($this->_pageContentRepo == null){
            $this->_pageContentRepo = new PageContentRepository($this->_em);
        }
        return $this->_pageContentRepo;
    }

    public function commit()
    {
        $this->_em->flush();
    }

    public function detach($entity)
    {
        $this->_em->detach($entity);
    }

    public function refresh($entity)
    {
        $this->_em->refresh($entity);
    }
}

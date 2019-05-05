<?php

namespace App\Repositories;

use App\Entities\PageContent;
use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;

class PageContentRepository extends GenericRepository{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, PageContent::class);
    }

    public function getByPageName($pageName){
        return $this->repo->findOneBy(
            ['pageName' => $pageName]
        );
    }
}
<?php

namespace App\Repositories\Base;

use Doctrine\ORM\EntityManager;
use App\Repositories\Interfaces\IRepository;
use Doctrine\ORM\QueryBuilder;

abstract class GenericRepository implements IRepository
{
    protected $em;
    protected $model;
    protected $repo;

    public function __construct(EntityManager $entityManager, $entityName)
    {
        $this->em = $entityManager;
        $this->model = $entityName;
        $this->repo = $this->em->getRepository($this->model);
    }

    public function all()
    {
        return $this->repo->findAll();
    }

    public function create($entity)
    {
        $this->em->persist($entity);
    }

    public function update($entity)
    {
        return $this->em->merge($entity);
    }

    public function delete($entity)
    {
        $this->em->remove($entity);
    }

    public function get($id)
    {
        return $this->em->find($this->model, $id);
    }

    public function where($predicate)
    {
        $query = $this->repo->createQueryBuilder($this->model)->where($predicate);
        return $query->getQuery()->getArrayResult();
    }
}
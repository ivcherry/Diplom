<?php

namespace App\Repositories\Interfaces;

interface IRepository
{
    public function all();

    public function create($entity);

    public function update($entity);

    public function delete($entity);

    public function get($id);

    public function where($predicate);
}
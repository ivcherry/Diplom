<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 22:49
 */

namespace App\Mappings;
use App\Entities\Sale;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class SaleMap extends EntityMapping
{
    public function mapFor()
    {
        return Sale::class;
    }
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('title')->length(150)->nullable();
        $builder->string('summary')->length(150)->nullable();
        $builder->string('text')->length(150)->nullable();
        $builder->datetime('date')->nullable();
    }

}
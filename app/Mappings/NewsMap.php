<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 22:49
 */

namespace App\Mappings;
use App\Entities\News;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class NewsMap extends EntityMapping
{
    public function mapFor()
    {
        return News::class;
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
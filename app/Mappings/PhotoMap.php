<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 22:49
 */

namespace App\Mappings;
use App\Entities\Photo;
use App\Entities\Product;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class PhotoMap extends EntityMapping
{
    public function mapFor()
    {
        return Photo::class;
    }
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('image')->length(150)->nullable();
        $builder->manyToOne(Product::class)->inversedBy('$photos');
    }

}
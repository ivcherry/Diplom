<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:26
 */

namespace App\Mappings;

use App\Entities\Review;
use App\Entities\Product;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class ReviewMap extends EntityMapping
{
    public function mapFor()
    {
        return Review::class;
    }

    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('value')->length(150)->nullable();
        $builder->datetime('date')->nullable();


        $builder->manyToOne(Product::class)->inversedBy('$reviews');
    }
}
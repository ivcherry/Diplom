<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.11.2017
 * Time: 0:58
 */

namespace App\Mappings;

use App\Entities\Feature;
use App\Entities\Product;
use App\Entities\ProductFeature;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class ProductFeatureMap extends EntityMapping
{

    public function mapFor()
    {
        return ProductFeature::class;
    }

    public function map(Fluent $builder)
    {

        $builder->string('value')->length(100)->nullable();

        $builder->manyToOne(Product::class)->inversedBy('features')->primary();
        $builder->manyToOne(Feature::class)->inversedBy('products')->primary();
    }
}
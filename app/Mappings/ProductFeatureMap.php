<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.11.2017
 * Time: 0:58
 */

namespace App\Mappings;

use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\ProductFeature;
use App\Entities\Product;
use App\Entities\Feature;

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
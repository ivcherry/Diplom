<?php

namespace App\Mappings;

use App\Entities\Product;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Feature;
use App\Entities\Type;
use App\Entities\ProductFeature;


class FeatureMap extends EntityMapping
{

    /**
     * Returns the fully qualified name of the class that this mapper maps.
     *
     * @return string
     */
    public function mapFor()
    {
        return Feature::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');

        $builder->string('name')->length('100');

        $builder->manyToMany(Type::class,'types')->inversedBy('features')->joinTable('type_feature');
        $builder->oneToMany(ProductFeature::class,'products')->mappedBy('feature');

    }
}
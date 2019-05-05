<?php
namespace App\Mappings;

use App\Entities\Type;
use App\Entities\GenericType;
use App\Entities\Product;
use App\Entities\Feature;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class TypeMap extends EntityMapping
{
    public function mapFor()
    {
        return Type::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');

        $builder->string('name')->nullable()->length(30)->unique();
        $builder->hasMany(Product::class)->mappedBy('type')->fetchLazy();
        $builder->manyToOne(GenericType::class)->inversedBy('types');
        $builder->manyToMany(Feature::class,'features')->mappedBy('types');
    }
}
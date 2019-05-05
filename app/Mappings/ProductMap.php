<?php
namespace App\Mappings;

use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Product;
use App\Entities\Type;
use App\Entities\Review;
use App\Entities\Photo;
use App\Entities\ProductFeature;

class ProductMap extends EntityMapping
{
    public function mapFor()
    {
        return Product::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');

        $builder->string('name')->nullable()->length(150)->unique();
        $builder->decimal('price')->nullable()->precision(10);
        $builder->string('description')->length(1500)->nullable();
        $builder->unsignedInteger('amount')->nullable();
        $builder->string('producer')->length(50)->nullable();

        $builder->manyToOne(Type::class)->inversedBy('products')->fetchLazy();
        $builder->oneToMany(Review::class)->mappedBy('product')->fetchLazy();
        $builder->oneToMany(Photo::class)->mappedBy('product')->fetchLazy();
        $builder->oneToMany('ProductFeature','features')->mappedBy('product');
        $builder->oneToMany('ProductOrder','orders')->mappedBy('product');
    }
}
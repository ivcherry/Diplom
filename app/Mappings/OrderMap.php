<?php

namespace App\Mappings;

use App\Entities\Product;
use App\Entities\ProductOrder;
use App\Entities\WorkScheduler;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Order;
use App\Entities\User;
use App\Entities\Type;


class OrderMap extends EntityMapping
{

    /**
     * Returns the fully qualified name of the class that this mapper maps.
     *
     * @return string
     */
    public function mapFor()
    {
        return Order::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->datetime('dateOfOrder');
        $builder->decimal('totalPrice')->nullable()->precision(10);
        $builder->manyToOne(User::class)->inversedBy('$orders');
        $builder->oneToMany(ProductOrder::class,'products')->mappedBy('order');
        $builder->oneToOne(WorkScheduler::class)->mappedBy('order');
    }
}
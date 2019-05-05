<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.11.2017
 * Time: 0:58
 */

namespace App\Mappings;

use App\Entities\Order;
use App\Entities\ProductOrder;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Product;

class ProductOrderMap extends EntityMapping
{

    public function mapFor()
    {
        return ProductOrder::class;
    }

    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->decimal('price')->nullable()->precision(10);
        $builder->unsignedInteger('amount')->nullable();

        $builder->manyToOne(Product::class)->inversedBy('orders');
        $builder->manyToOne(Order::class)->inversedBy('products');
    }
}
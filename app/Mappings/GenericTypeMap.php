<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.10.2017
 * Time: 18:06
 */

namespace App\Mappings;
use App\Entities\Type;
use App\Entities\GenericType;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class GenericTypeMap extends EntityMapping
{
    public function mapFor()
    {
        return GenericType::class;
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
        $builder->oneToMany(Type::class)->mappedBy('genericType')->fetchLazy();
    }
}
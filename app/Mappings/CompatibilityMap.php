<?php

namespace App\Mappings;

use App\Entities\Feature;
use App\Entities\Type;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Compatibility;

class CompatibilityMap extends EntityMapping{

    /**
     * Returns the fully qualified name of the class that this mapper maps.
     *
     * @return string
     */
    public function mapFor()
    {
        return Compatibility::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('rule')->nullable()->length(100);
        $builder->manyToOne(Feature::class, 'firstFeature')->addJoinColumn('firstFeature', 'first_feature_id', 'id',false, false, 'cascade');
        $builder->manyToOne(Feature::class, 'secondFeature')->addJoinColumn('secondFeature', 'second_feature_id', 'id', false, false, 'cascade');
        $builder->manyToOne(Type::class, 'firstType')->addJoinColumn('firstType', 'first_type_id', 'id', false, false, 'cascade');
        $builder->manyToOne(Type::class, 'secondType')->addJoinColumn('secondType', 'second_type_id', 'id', false,false,'cascade');
    }
}
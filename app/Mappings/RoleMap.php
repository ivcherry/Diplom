<?php
namespace App\Mappings;

use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use \App\Entities\Role;
use App\Entities\User;
class RoleMap extends EntityMapping
{

    /**
     * Returns the fully qualified name of the class that this mapper maps.
     *
     * @return string
     */
    public function mapFor()
    {
        return Role::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');

        $builder->string('name')->length(20);
        $builder->string('description')->length(150);

        $builder->manyToMany(User::class)->mappedBy('roles')->joinTable('user_role');
    }
}
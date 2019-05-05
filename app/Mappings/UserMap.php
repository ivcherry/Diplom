<?php
namespace App\Mappings;
use App\Entities\Order;
use App\Entities\User;
use App\Entities\WorkScheduler;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Role;
class UserMap extends EntityMapping
{
    public function mapFor()
    {
        return User::class;
    }

    public function map (Fluent $builder)
    {
        $builder->increments('id');

        $builder->string('fullName')->length(50);
        $builder->string('email')->length(100)->unique();
        $builder->string('password')->length(60);
        $builder->string('rememberToken')->length(100)->nullable();

        $builder->manyToMany(Role::class)->inversedBy('users')->joinTable('user_role');
        $builder->oneToMany(Order::class)->mappedBy('user')->fetchLazy();
        $builder->oneToMany(WorkScheduler::class)->mappedBy('user')->fetchLazy();
    }
}
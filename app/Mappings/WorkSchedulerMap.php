<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 22:49
 */

namespace App\Mappings;
use App\Entities\WorkScheduler;
use App\Entities\Order;
use App\Entities\User;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class WorkSchedulerMap extends EntityMapping
{
    public function mapFor()
    {
        return WorkScheduler::class;
    }
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->datetime('date')->length(150)->nullable();
        $builder->string('timeSlot')->length(1500)->nullable();
        $builder->integer('status')->nullable();
        $builder->manyToOne(User::class)->inversedBy('$workSchedulers');
        $builder->oneToOne(Order::class)->inversedBy('workScheduler');
    }
}
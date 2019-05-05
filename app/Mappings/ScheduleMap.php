<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 22:49
 */

namespace App\Mappings;
use App\Entities\Schedule;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class ScheduleMap extends EntityMapping
{
    public function mapFor()
    {
        return Schedule::class;
    }
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('day')->length(150);
        $builder->string('timeSlots')->length(1500)->nullable();
    }

}
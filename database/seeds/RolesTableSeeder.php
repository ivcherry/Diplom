<?php

use Illuminate\Database\Seeder;
use App\Entities\UserRoles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert(
            [
                [
                    'name' => UserRoles::Admin,
                    'description' => "Роль администратора сайта."
                ],
                [
                    'name' => UserRoles::Customer,
                    'description' => "Роль клиента сайта"
                ],
                [
                    'name' => UserRoles::Worker,
                    'description' => "Роль рабочего"
                ]
            ]
        );


    }
}

<?php

use Illuminate\Database\Seeder;

class PageContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('page_contents')->insert(
            [
                [
                    'content' => "",
                    'page_name' => "companyHistory"
                ],
                [
                    'content' => "",
                    'page_name' => "contactInfo"
                ],
                [
                    'content' => "",
                    'page_name' => "technicalSupport"
                ],
                [
                    'content' => "",
                    'page_name' => 'howToFindUs'
                ]
            ]
        );


    }
}

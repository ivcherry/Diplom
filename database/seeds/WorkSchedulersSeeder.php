<?php

use Illuminate\Database\Seeder;

class WorkSchedulersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $arrSlot = [
            "{\"start\":\"8.00\", \"end\": \"8.30\" }",
            "{\"start\":\"8.30\", \"end\": \"9.00\" }",
            "{\"start\":\"9.00\", \"end\": \"9.30\" }",
            "{\"start\":\"9.30\", \"end\": \"10.00\" }",
            "{\"start\":\"10.00\", \"end\": \"10.30\" }",
            "{\"start\":\"10.30\", \"end\": \"11.00\" }",
            "{\"start\":\"11.00\", \"end\": \"11.30\" }",
            "{\"start\":\"11.30\", \"end\": \"12.00\" }",
            "{\"start\":\"12.00\", \"end\": \"12.30\" }",
            "{\"start\":\"12.30\", \"end\": \"13.00\" }",
            "{\"start\":\"13.00\", \"end\": \"13.30\" }",
            "{\"start\":\"13.30\", \"end\": \"14.00\" }",
            "{\"start\":\"14.00\", \"end\": \"14.30\" }",
            "{\"start\":\"14.30\", \"end\": \"15.00\" }",
            "{\"start\":\"15.00\", \"end\": \"15.30\" }",
            "{\"start\":\"15.30\", \"end\": \"16.00\" }",
            "{\"start\":\"16.00\", \"end\": \"16.30\" }",
            "{\"start\":\"16.30\", \"end\": \"17.00\" }",
            "{\"start\":\"17.00\", \"end\": \"17.30\" }",
            "{\"start\":\"17.30\", \"end\": \"18.00\" }"
        ];
        $arrDate = ["2017-12-11", "2017-12-12", "2017-12-13", "2017-12-14", "2017-12-15"];
        $arr = array();


        foreach ($arrDate as $date) {
            foreach ($arrSlot as $slot) {
                array_push($arr, [
                        'user_id' => 1,
                        'date' => $date,
                        'time_slot' => $slot,
                        'status' => 1
                    ]
                );
            }
        }


        DB::table('work_schedulers')->insert($arr
//            [
//                [
//                    'user_id' => 1,
//                    'date' => "2017-12-11",
//                    'time_slot' => "{\"start\":8.00, \"end\": 8.30 }",
//                    'status' => 1
//                ],
//                [
//                    'user_id' => 1,
//                    'date' => "2017-12-11",
//                    'time_slot' => "{\"start\":8.30, \"end\": 9.00 }",
//                    'status' => 1
//                ]
//            ]
        );
    }
}

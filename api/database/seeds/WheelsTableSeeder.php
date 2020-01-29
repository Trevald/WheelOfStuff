<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WheelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wheels')->insert([
            'id' => Str::orderedUuid(),
            'data' => json_encode(
                (object) [
                    "title" => "Fruits",
                    "items" => array(
                        (object) [ "title" => "Apple" ],
                        (object) [ "title" => "Banana" ],
                        (object) [ "title" => "Orange" ],
                        (object) [ "title" => "Pear" ],
                        (object) [ "title" => "Pineapple" ]
                    )
                ]
            ),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Carbon\Carbon;

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
            'public' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),            
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

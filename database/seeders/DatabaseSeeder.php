<?php

namespace Database\Seeders;

use App\Models\Mdcat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//        for ($i = 0; $i <= 100; $i++) {
//            DB::table('mdcats')->insert([
//                'name' => Str::random(10),
//                'cnic' => uniqid(),
//                'marks' => rand(1,210),
//                'roll_no' => rand(100,1000000),
//            ]);
//        }
    }
}

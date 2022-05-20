<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Today;
use Illuminate\Support\Str;

class TodaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i<5 ; $i++) { 
            Today::create([
                'task_id'   => Str::random(10),
                'title'     => $faker->sentence($nbWords = 4, $varialbeWords = false),
                'completed' => false,
                'approved'  => false
            ]);
        }
    }
}

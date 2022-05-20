<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Upcoming;
use Illuminate\Support\Str;

class UpcomingSeeder extends Seeder
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
            Upcoming::create([
                'task_id'   => Str::random(10),
                'title'     => $faker->sentence($nbWords = 4, $varialbeWords = false),
                'completed' => false,
                'approved'  => false,
                'waiting'   => true
            ]);
        }
    }
}

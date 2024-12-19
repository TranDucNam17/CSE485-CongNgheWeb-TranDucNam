<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 100; $i++) {
            $computerId = DB::table('computers') -> insertGetId([
                'computer_name' => $faker->name(),
                'model' => $faker->word(),
                'operating_system' => $faker->word(),
                'processor' => $faker->word(),
                'memory' => $faker->numberBetween(1024, 8192),
                'available' => $faker->boolean()
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $issuesCount = rand(1,5);
        for($i = 0; $i < $issuesCount ; $i++){  
            $computerId = DB::table('computers')->inRandomOrder()->value('id');
            if($computerId)
            {
                DB::table('issues')->insert([
                    'reported_by' => $faker->name(),
                    'reported_date' => $faker->dateTime(),
                    'description' => $faker->paragraph(3),
                    'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                    'computer_id' => $computerId
                ]);
            }             
        }
    }
}

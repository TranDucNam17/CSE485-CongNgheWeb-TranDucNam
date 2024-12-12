<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ClassesAndStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){
            $classId = DB::table('classes') -> insertGetId([
                'grade_level' => $faker->randomElement(['Pre-K', 'Kindergarten']),
                'room_number' => $faker->randomElement(['VH1', 'VH2', 'VH3', 'VH4', 'VH5', 'VH6'])
            ]);

            $studentsCount = rand(1,5);
            for($j = 0; $j < $studentsCount; $j++){
                DB::table('students')->insert([
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'date_of_birth' => $faker->date('Y-m-d'),
                    'parent_phone' => $faker->phoneNumber(),
                    'id' => $classId
                ]);
            }
        }
    }
}
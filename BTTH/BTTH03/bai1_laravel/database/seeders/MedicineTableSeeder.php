<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $medicine_id = DB::table('medicines')->pluck('medicine_id')->toArray(); 
        foreach (range(1, 100) as $index) { 
            DB::table('medicines')->insert([
                'name' => $faker->name,
                'brand' => $faker->company,
                'dosage' => $faker-randomElement(['5mg', '10mg', '20mg']),
                'form' => $faker->randomElement(['viên nén', 'viên nang', 'dung dịch']),
                'price' => $faker->randomFloat(2, 10, 100),
                'stock' => $faker->numberBetween(10, 100)
            ]);
        }
    }
}

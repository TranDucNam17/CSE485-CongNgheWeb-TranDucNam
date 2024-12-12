<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
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
            DB::table('sales')->insert([
                'quantity' => $faker->numberBetween(1, 10),
                'sale_date' => $faker->date(),
                'customer_phone' => $faker->phoneNumber,
                'medicine_id' => $faker->randomElement($medicine_id)
            ]);
        }
    }
}

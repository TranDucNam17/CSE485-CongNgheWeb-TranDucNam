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
        $faker = Faker::create();

        // Lấy danh sách tất cả các computer_id từ bảng 'computers'
        $computerId = DB::table('computers')->pluck('id')->toArray();

        // Kiểm tra nếu không có computer_id nào trong bảng 'computers'
        if (empty($computerId)) {
            $this->command->warn('No computers found in the database. Run ComputersTableSeeder first.');
            return;
        }

        // Tạo dữ liệu cho bảng 'issues'
        for ($i = 0; $i < 100; $i++) {
            DB::table('issues')->insert([
                'reported_by' => $faker->name(),
                'reported_date' => $faker->dateTime(),
                'description' => $faker->paragraph(3),
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                // Lấy ngẫu nhiên một computer_id từ danh sách
                'computer_id' => $faker->randomElement($computerId),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        for ($i = 0; $i < 200; $i++) {
            $startDate = now()->startOfYear()->addYears(-1); // Đặt ngày bắt đầu từ đầu năm 2024
            $endDate = now(); // Lấy ngày hiện tại

            $daysDiff = $endDate->diffInDays($startDate); // Số ngày giữa ngày bắt đầu và ngày kết thúc

            $transportDate = $startDate->copy()->addDays(rand(0, $daysDiff));
            $returnDate = $transportDate->copy()->addDays(4);

            DB::table('orders')->insert([
                'oder_code' => rand(100000, 999999),
                'payment' => rand(1, 2),
                'transport_date' => $transportDate,
                'return_date' => $returnDate,
                'quantity' => 1,
                'price' => 999000,
                'status' => rand(1, 3),
                'viewed' => 0,
                'discount_code' => null,
                'customer_info_full_name' => $faker->name,
                'customer_info_address' => 'Số nhà ' . rand(1, 100) . ', Đường ' . Str::random(5) . ', Quận ' . Str::random(5),
                'customer_info_email' => Str::random(8) . '@example.com',
                'customer_info_body' => $faker->realText(20),
                'customer_info_phone' => '0' . rand(1, 9) . rand(0, 9) . rand(10000000, 99999999),
                'product_id' => rand(32, 65),
                'user_id' => rand(1, 55),
                'created_at' => $transportDate->format('Y-m-d H:i:s'), // Định dạng ngày giờ chính xác
                'updated_at' => now()->format('Y-m-d H:i:s'), // Định dạng ngày giờ chính xác
            ]);
        }
    }
}

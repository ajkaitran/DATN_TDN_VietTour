<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userSeed = [];

        for ($i = 0; $i < 20; $i++) {
            $userSeed[] = [
                'name' => $faker->firstName . ' ' . $faker->lastName,  // Tạo tên đầy đủ
                'image' => null,  // Để null cho image
                'phone' => '0' . $faker->numberBetween(100000000, 999999999),  // Số điện thoại hợp lệ
                'email' => $faker->unique()->safeEmail,  // Địa chỉ email hợp lệ
                'username' => $faker->userName,  // Tên đăng nhập ngẫu nhiên
                'password' => bcrypt('123456'),  // Mã hóa mật khẩu với bcrypt
                'role' => 3,  // Gán giá trị role là 2
                'status' => 1,  // Gán giá trị status là 1
            ];
        }

        DB::table('users')->insert($userSeed);
    }
}

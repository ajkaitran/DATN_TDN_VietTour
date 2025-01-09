<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',  // Tên tài khoản
            'email' => 'admin@gmail.com',  // Email
            'password' => Hash::make('123456'),  // Mật khẩu (đảm bảo mã hóa)
            'role' => 0,  // Giả sử role 0 là admin
            'status' => 1,  // Đảm bảo tài khoản này đang hoạt động
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN'); // Sử dụng Faker với ngôn ngữ tiếng Việt
        $articlesSeed = [];

        for ($i = 0; $i < 20; $i++) {
            $articlesSeed[] = [
                'subject' => $faker->realText(100),  // Tiêu đề bài viết về du lịch < 100 ký tự
                'description' => $faker->realText(500),  // Mô tả ngắn liên quan đến tiêu đề < 500 ký tự
                'active' => 1,  // Bài viết kích hoạt
                'article_category_id' => $faker->numberBetween(1, 11),  // Ngẫu nhiên từ 1 đến 11
                'image' => null,  // Hình ảnh để null
                'body' => $faker->realText(1000),  // Nội dung bài viết > 1000 từ
                'view' => 0,  // Lượt xem ban đầu là 0
                'hot' => 0,  // Bài viết không phải là hot
                'url' => null,  // URL để null
                'created_at' => $faker->dateTimeBetween('2024-11-01', 'now'),  // Ngày tạo từ 1/11/2024 đến hiện tại
                'updated_at' => now(),
            ];
        }

        DB::table('articles')->insert($articlesSeed);
    }
}

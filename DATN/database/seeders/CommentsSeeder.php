<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN'); // Sử dụng Faker với ngôn ngữ tiếng Việt
        $commentsSeed = [];
        
        for ($i = 0; $i < 30; $i++) {
            $commentsSeed[] = [
                'user_id' => $faker->numberBetween(34, 53),  // Ngẫu nhiên lấy từ 34 đến 53
                'article_id' => $faker->numberBetween(1, 40),  // Ngẫu nhiên lấy từ 1 đến 40
                'content' => $faker->realTextBetween(20, 100),  // Nội dung bình luận từ 20 đến 100 từ
                'status' => 1,  // Trạng thái bình luận là 1
                'created_at' => $faker->dateTimeBetween('2024-11-01', 'now'), 
                'updated_at' => now(),
            ];
        }
        
        DB::table('comments')->insert($commentsSeed);
    }
}

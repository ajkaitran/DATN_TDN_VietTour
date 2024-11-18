<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_type')->default(0); // Loại danh mục (0: Trong nước, 1: Quốc tế)
            $table->string('name', 100); // Tên loại tour
            $table->string('home_name', 100)->nullable(); // Tên hiển thị trên trang Home
            $table->string('image')->nullable(); // Đường dẫn ảnh
            $table->integer('order')->default(0); // Thứ tự hiển thị
            $table->boolean('show_menu')->default(0); // Hiển thị trên Menu
            $table->boolean('active')->default(1); // Trạng thái hoạt động
            $table->boolean('show_home')->default(0); // Hiển thị trên Home
            $table->string('slug', 150)->unique(); // Đường dẫn
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_categories');
    }
};

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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->string('full_name'); // Họ tên
            $table->string('address')->nullable(); // Địa chỉ
            $table->string('position')->nullable(); // Chức vụ
            $table->string('image')->nullable(); // Đường dẫn ảnh (có thể rỗng)
            $table->text('comment'); // Lời nhận xét
            $table->tinyInteger('type'); // Loại phản hồi (ví dụ: 0 - Khách hàng, 1 - Nhân viên)
            $table->integer('order')->default(0); // Thứ tự hiển thị
            $table->boolean('active')->default(1); // Trạng thái hoạt động
            $table->timestamps(); // created_at và updated_at
            $table->softDeletes(); // deleted_at (xóa mềm)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};

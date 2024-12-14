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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID sản phẩm
            $table->unsignedBigInteger('start_places_id'); // điẻm khởi hành
            $table->unsignedBigInteger('category_type_id'); // Loại tour
            $table->integer('main_category_id'); // danh mục chính
            $table->unsignedBigInteger('product_category_id'); // Mã danh mục tour mà sản phẩm thuộc về (liên kết với bảng product_categories)
            $table->string('name', 100); // Tên combo tour
            $table->string('description', 1000)->nullable(); // Trích dẫn ngắn mô tả về tour (ví dụ: mô tả ngắn gọn về combo)
            $table->string('product_code', 50)->nullable(); // Mã combo tour (mã sản phẩm duy nhất)
            $table->text('attractions')->nullable(); // Điểm tham quan của tour
            $table->text('image')->nullable(); // Hình ảnh (có thể chứa URL hoặc mã hóa base64)
            $table->text('highlights')->nullable(); // Những điểm đặc sắc của combo
            $table->text('schedule')->nullable(); // Lịch khởi hành của tour 
            $table->string('transport', 100)->nullable(); // Phương tiện di chuyển trong tour (máy bay, xe, tàu,...)
            $table->integer('star')->default(0); // Đánh giá sao của khách sạn hoặc dịch vụ tour
            $table->integer('price')->nullable(); // Giá tour (hoặc combo) gốc
            $table->integer('sale_off')->nullable(); // Giá khuyến mãi hoặc giảm giá
            $table->string('hotline', 15)->nullable(); // Số hotline liên hệ
            $table->text('package_price')->nullable(); // Chi tiết giá tour trọn gói
            $table->text('price_included')->nullable(); // Những dịch vụ và chi phí đã bao gồm trong tour
            $table->text('price_excluded')->nullable(); // Những dịch vụ và chi phí không bao gồm trong tour
            $table->text('children_policy')->nullable(); // Chính sách trẻ em (ví dụ: miễn phí cho trẻ em dưới 2 tuổi)
            $table->text('registration_terms')->nullable(); // Các điều khoản đăng ký và thanh toán
            $table->text('cancellation_policy')->nullable(); // Chính sách hủy tour
            $table->text('visa_info')->nullable(); // Thông tin về visa (nếu có)
            $table->text('notes')->nullable(); // Các lưu ý khác (ví dụ: hành lý, thời gian tham gia,...)
            $table->integer('view')->default(0); // Số lượt xem của sản phẩm trên website
            $table->integer('sort')->default(0); // Thứ tự hiển thị (ví dụ: để sắp xếp các combo tour theo mức độ ưu tiên)
            $table->boolean('hot')->default(0); // Xác định tour này có được làm nổi bật không (ví dụ: tour hot)
            $table->boolean('home_page')->default(0); // Combo tour hiển thị trang chủ
            $table->boolean('active')->default(0); // Trạng thái tour còn hoạt động hay không
            $table->string('tags', 255)->nullable(); // Từ khóa tìm kiếm cho tour (dễ dàng tìm kiếm trên website)
            $table->string('url', 500)->nullable(); // URL dẫn đến trang chi tiết tour sản phẩm
            $table->string('title', 255)->nullable(); // Tiêu đề của combo tour
            $table->text('detailed_description')->nullable(); // Mô tả chi tiết về tour
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('start_places_id')->references('id')->on('start_places')->onDelete('cascade');
            $table->foreign('category_type_id')->references('id')->on('product_categories_type')->onDelete('cascade');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

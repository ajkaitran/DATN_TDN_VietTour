<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'start_places_id',         // Điểm khởi hành
        'category_type_id',
        'main_category_id',       // Loại tour
        'product_category_id',     // Mã danh mục tour
        'name',                    // Tên combo tour
        'description',             // Trích dẫn ngắn
        'product_code',            // Mã combo tour
        'attractions',             // Điểm tham quan
        'image',                   // Hình ảnh
        'highlights',              // Những điểm đặc sắc
        'schedule',                // Lịch khởi hành
        'transport',               // Phương tiện di chuyển
        'star',                    // Đánh giá sao
        'price',                   // Giá gốc
        'sale_off',                // Giá khuyến mãi
        'hotline',                 // Hotline liên hệ
        'package_price',           // Giá tour trọn gói
        'price_included',          // Dịch vụ đã bao gồm
        'price_excluded',          // Dịch vụ chưa bao gồm
        'children_policy',         // Chính sách trẻ em
        'registration_terms',      // Điều khoản đăng ký
        'cancellation_policy',     // Chính sách hủy
        'visa_info',               // Thông tin visa
        'notes',                   // Lưu ý khác
        'view',                    // Số lượt xem
        'sort',                    // Thứ tự hiển thị
        'hot',                     // Nổi bật
        'home_page',               // Hiển thị trang chủ
        'active',                  // Trạng thái hoạt động
        'tags',                    // Từ khóa tìm kiếm
        'url',                     // URL chi tiết
        'title',                   // Tiêu đề
        'detailed_description', // mô tả ch tiết
        'article_id'  // bài viết
    ];

    /**
     * Quan hệ với bảng danh mục tour.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Quan hệ với bảng loại tour.
     */
    public function type()
    {
        return $this->belongsTo(ProductCategoryType::class, 'category_type_id');
    }
    public function itineraries()
    {
        return $this->hasMany(Itinerary::class, 'product_id'); // combo_id là khóa ngoại
    }
    public function startplace()
    {
        return $this->belongsTo(StartPlace::class, 'start_places_id');

    }
    public function article(){
        return $this->belongsTo(Article::class, 'article_id');
    }
}

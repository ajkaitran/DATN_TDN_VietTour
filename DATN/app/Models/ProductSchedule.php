<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSchedule extends Model
{
    use HasFactory;

    protected $table = 'product_schedules';

    protected $fillable = [
        'name',
        'description',
        'product_category_id',
        'active',
        'price1',
        'price2',
        'price3',
        'price4',
        'price5',
        'original_price',
        'dat_coc',
        'do_tuoi_tre_em',
        'do_tuoi_tre_nho',
        'do_tuoi_em_be',
        'tieu_de_phu_thu',
        'product_code',
        'time',
        'active',
        'gift',
        'gift_note',
        'slot',
        'url',
        'url_book_tour',
        'email',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_code');
    }

    public function product_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}

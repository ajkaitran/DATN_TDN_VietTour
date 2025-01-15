<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'oder_code',
        'payment',
        'transport_date',
        'return_date',
        'quantity',
        'price',
        'status',
        'viewed',
        'discount_code',
        'customer_info_full_name',
        'customer_info_address',
        'customer_info_email',
        'customer_info_body',
        'customer_info_phone',
        'product_id',
        'user_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function itinerary()
    {
        return $this->hasManyThrough(Itinerary::class, Product::class, 'product_id', 'id', 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Assess()
    {
        return $this->hasOne(Assess::class, 'order_id');
    }

    public function isAssessed()
    {
        return $this->Assess()->exists();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'oder_code',
        'payment',
        'transport_date',
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
    ];
}

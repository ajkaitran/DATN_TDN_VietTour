<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHotel extends Model
{
    use HasFactory;

    protected $table = 'order_hotels';

    protected $fillable = [
        'payment',
        'transport_date',
        'quantity',
        'price',
        'status',
        'viewed',
        'discount_code',
        'customer_info_hotel_full_name',
        'customer_info_hotel_address',
        'customer_info_hotel_email',
        'customer_info_hotel_body',
        'customer_info_hotel_phone',
        'hotel_id',
    ];
}

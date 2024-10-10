<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSchedule extends Model
{
    use HasFactory;

    protected $table = 'order_schedules';
    
    protected $fillable = [
        'order_code',
        'payment', 
        'type_pay',
        'dat_coc',
        'transport_date',
        'quantity1',
        'price1',
        'quantity2',
        'price2',
        'quantity3',
        'price3',
        'quantity4',
        'price4',
        'quantity5',
        'price5',
        'product_schedule_id',
        'product_id',
        'status',
        'body',
        'discount_code',   
        'customer_info_full_name',
        'customer_info_address',
        'customer_info_email',
        'customer_info_body',
        'customer_info_phone',
        'vehicle'
    ];
}

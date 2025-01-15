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
    public function insertDataOrder($params){
        $params['oder_code'] = rand(100000, 999999);
        $params['payment'] = 1;
        $params['transport_date'] = now();
        $params['discount_code'] = null;
        $params['viewed'] = 0;
        $params['status'] = 1;
        $res = Order::query()->create($params);
        return $res;
    }
    
}

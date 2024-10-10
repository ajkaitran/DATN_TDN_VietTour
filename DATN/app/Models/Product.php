<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'star',
        'body',
        'product_category_id',
        'price',
        'sale_off',
        'product_code',
        'hot',
        'active',
        'pay_url',
        'url',
        'view',
    ];
}

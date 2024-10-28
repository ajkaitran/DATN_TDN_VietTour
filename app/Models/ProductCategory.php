<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'city',
        'image',
        'cover_image',
        'url',
        'sort',
        'active',
        'hot',
        'parent_id',
        'hotline',
        'body',
        'type',
        'temp_city',
        'time_get_temp',
    ];
}

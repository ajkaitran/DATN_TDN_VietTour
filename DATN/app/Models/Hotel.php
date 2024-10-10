<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'subject',
        'description',
        'body',
        'address',
        'phone',
        'email',
        'price',
        'price_sale',
        'star',
        'image',
        'hotel_category_id',
        'active',
        'url',
    ];
}

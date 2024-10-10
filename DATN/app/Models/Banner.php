<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'banner_name',
        'image',
        'image_mobile',
        'active',
        'group_id',
        'url',
        'sort',
        'slogan'
    ];
}

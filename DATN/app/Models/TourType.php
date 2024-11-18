<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tour_categories';

    protected $fillable = [
        'category_type',
        'name',
        'home_name',
        'image',
        'orde',
        'show_menu',
        'active',
        'show_home',
        'slug'
    ];
}

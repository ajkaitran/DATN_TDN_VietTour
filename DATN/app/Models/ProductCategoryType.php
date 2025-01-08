<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategoryType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_categories_type';
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
    public function products()
    {
        return $this->hasMany(Product::class, 'category_type_id', 'id');
    }

}

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
        'url',
        'sort',
        'active',
        'hot',
        'parent_id',
        'hotline',
        'meta_title',
        'meta_description',
        'type',
        'time_get_temp',
    ];
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

}

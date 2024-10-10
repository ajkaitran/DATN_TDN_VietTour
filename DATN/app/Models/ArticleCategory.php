<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = ['category_name', 'url', 'category_sort', 'category_active', 'parent_id', 'type_post', 'created_at', 'updated_at'];
}

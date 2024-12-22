<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = ['category_name', 'url', 'category_sort', 'category_active', 'parent_id', 'type_post', 'created_at', 'updated_at'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(ArticleCategory::class, 'parent_id', 'id');
    }
}

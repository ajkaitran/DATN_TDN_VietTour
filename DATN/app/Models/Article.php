<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $fillable = [
        'subject',
        'description',
        'active',
        'article_category_id',
        'image',
        'body',
        'view',
        'hot',
        'url',
    ];

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }
}

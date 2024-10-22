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
        'show_block',
        'show_footer',
        'url',
    ];
}

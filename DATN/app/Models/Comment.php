<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'article_id',
        'content',
        'status'
    ];
    public function loadAllUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function loadAllArticle(){
        return $this->belongsTo(Article::class,'article_id');
    }
    public function loadListComment(){
        $query = Comment::query()
            ->with('loadAllUser')
            ->with('loadAllArticle')
            ->orderBy('id')
            ->paginate(5);
        return $query;
    }
}

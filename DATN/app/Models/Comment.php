<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'article_id',
        'content',
        'status',
    ];

    public function loadAllUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loadAllArticle()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function loadListComment($filters = [])
    {
        $query = Comment::query()
            ->with('loadAllUser')
            ->with('loadAllArticle')
            ->orderBy('id');

        // Áp dụng bộ lọc theo bài viết
        if (!empty($filters['article_id'])) {
            $query->where('article_id', $filters['article_id']);
        }

        return $query->paginate(5);
    }
}

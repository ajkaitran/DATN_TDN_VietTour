<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $view;

    public function __construct()
    {
        $this->view = [];
    }

    public function index(Request $request)
    {
        $objComment = new Comment();

        // Lấy danh sách bài viết để hiển thị trong dropdown
        $this->view['articles'] = Article::all();

        // Lấy tham số lọc từ request
        $filters = [
            'article_id' => $request->get('article_id'),
        ];

        // Lấy danh sách bình luận áp dụng bộ lọc
        $this->view['listComment'] = $objComment->loadListComment($filters);

        return view('comment.index', $this->view);
    }
}


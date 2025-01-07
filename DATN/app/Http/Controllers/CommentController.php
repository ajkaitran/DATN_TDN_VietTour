<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index(){
        $objComment = new Comment();
        $this->view['listComment'] = $objComment->loadListComment();
        return view('comment.index', $this->view);
    }
}

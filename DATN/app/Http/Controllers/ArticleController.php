<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.article.index');
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        return view('admin.article.show');
    }

    public function edit()
    {
        return view('admin.article.edit');
    }
}

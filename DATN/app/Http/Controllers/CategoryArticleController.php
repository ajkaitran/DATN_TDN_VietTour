<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryArticle\StoreRequest;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class CategoryArticleController extends Controller
{
    public function index()
    {
        $data = ArticleCategory::all();
        return view('categoryArticle.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ArticleCategory::all();
        return view('categoryArticle.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $active = $request->input('category_active') ? 1 : 0;

        ArticleCategory::create([
            ...$request->all(),
            'category_active' => $active,
        ]);
        return redirect()->route('categoryArticle.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = ArticleCategory::find($id);
        $categories = ArticleCategory::all();
        return view('categoryArticle.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $active = $request->input('category_active') ? 1 : 0;

        $response = ArticleCategory::where('id', $id)->update([
            'category_name' => $request->input('category_name'),
            'url' => $request->input('url'),
            'parent_id' => $request->input('parent_id'),
            'category_sort' => $request->input('category_sort'),
            'type_post' => $request->input('type_post'),
            'category_active' => $active,
        ]);
        if (!$response) {
            return redirect()->route('categoryArticle.edit', $id)->with('error', 'Updated failed!');
        }
        return redirect()->route('categoryArticle.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $response = ArticleCategory::where('id', $id)->delete();
        if (!$response) {
            return redirect()->route('categoryArticle.index')->with('error', 'Deleted failed!');
        }
        return redirect()->route('categoryArticle.index')->with('success', 'Deleted successfully!');
    }
}

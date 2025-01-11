<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Service\Common\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $active = $request->input('active');
        $category = $request->input('category');

        $query = Article::query();

        if ($search) {
            $query->where('subject', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($active !== null) {
            $query->where('active', $active);
        }

        if ($category) {
            $query->where('article_category_id', $category);
        }

        $articles = $query->paginate(5);
        $categories = ArticleCategory::all();

        return view('article.index', compact('articles', 'categories'));
    }


    public function create()
    {
        $categories = ArticleCategory::all();
        return view('article.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $active = $request->input('active') ? 1 : 0;
        $hot = $request->input('hot') ? 1 : 0;
        $imageName = $this->imageService->uploadImage($request->file('image'), 'article');
        $response = Article::create([
            ...$request->all(),
            'image' => $imageName ?? null,
            'active' => $active,
            'hot' => $hot,
            'view' => 0,
        ]);

        if (!$response) {
            return redirect()->route('article.create')->with('error', 'Created failed!');
        }

        return redirect()->route('article.index')->with('success', 'Created successfully!');
    }

    public function edit(int $id)
    {
        $article = Article::find($id);
        $categories = ArticleCategory::all();
        return view('article.edit', compact('article', 'categories'));
    }

    function update(UpdateArticleRequest $request, int $id)
    {
        $article = Article::find($id);
        $active = $request->input('active') ? 1 : 0;
        $hot = $request->input('hot') ? 1 : 0;
        if ($request->hasFile('image')) {
            $this->imageService->deleteImage($article->image, 'article');
            $imageName = $this->imageService->uploadImage($request->file('image'), 'article');
        } else {
            $imageName = $article->image;
        }
        $response = $article->update([
            ...$request->all(),
            'image' => $imageName,
            'active' => $active,
            'hot' => $hot,
        ]);

        if (!$response) {
            return redirect()->route('article.edit', $id)->with('error', 'Updated failed!');
        }

        return redirect()->route('article.index')->with('success', 'Updated successfully!');
    }

    function destroy(int $id)
    {
        $article = Article::find($id);
        if ($article) {
            $this->imageService->deleteImage($article->image, 'article');
            $article->delete();
            return redirect()->route('article.index')->with('success', 'Deleted successfully!');
        }
        return redirect()->route('article.index')->with('error', 'Deleted failed!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryTour\StoreRequest;
use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
use App\Service\Admin\TourCategoryService;
use Illuminate\Http\Request;

class TourCategoryController extends Controller
{
    public function __construct(private TourCategoryService $tourCategoryService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductCategory::paginate(5);
        $typeTour = ProductCategoryType::all();
        return view('tourCategory.index', compact('data', 'typeTour'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $typeTour = ProductCategoryType::all();
        return view('tourCategory.create', compact('categories', 'typeTour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image');
        $response = $this->tourCategoryService->store($data);
        if (!$response) {
            return redirect()->route('tourCategory.create')->with('error', 'Created failed!');
        }
        return redirect()->route('tourCategory.index')->with('success', 'Created successfully!');
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
        $category = ProductCategory::find($id);
        $categories = ProductCategory::all();
        $typeTour = ProductCategoryType::all();
        return view('tourCategory.edit', compact('category', 'categories', 'typeTour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['image'] = $request->file('image');
        $response = $this->tourCategoryService->update($id, $data);
        if (!$response) {
            return redirect()->route('tourCategory.edit', $id)->with('error', 'Updated failed!');
        }
        return redirect()->route('tourCategory.index')->with('success', 'Updated successfully!');
    }

    public function quickUpdate(Request $request)
    {
        $id = $request->input('id');
        $hot = $request->input('hot');
        $home_page = $request->input('home_page');
        $active = $request->input('active');

        $tourCate = ProductCategory::find($id);
        if ($tourCate) {
            $tourCate->hot = $hot;
            $tourCate->home_page = $home_page;
            $tourCate->active = $active;
            $tourCate->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function destroy(int $id)
    {
        $response = $this->tourCategoryService->destroy($id);
        if (!$response) {
            return redirect()->route('tourCategory.index')->with('error', 'Deleted failed!');
        }
        return redirect()->route('tourCategory.index')->with('success', 'Deleted successfully!');
    }
}

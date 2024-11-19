<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryTour\StoreRequest;
use App\Models\ProductCategory;
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
        $data = ProductCategory::all();
        return view('tourCategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tourCategory.create');
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
        return view('tourCategory.edit', compact('category'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $response = $this->tourCategoryService->destroy($id);
        if (!$response) {
            return redirect()->route('tourCategory.index')->with('error', 'Deleted failed!');
        }
        return redirect()->route('tourCategory.index')->with('success', 'Deleted successfully!');
    }
}

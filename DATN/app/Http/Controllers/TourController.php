<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Tour\StoreTourRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSchedule;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = ProductSchedule::all();
        return view('tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryTour = ProductCategory::all();
        return view('tour.create', compact('categoryTour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        $active = isset($request->active) ? 1 : 0;
        ProductSchedule::create([
            ...$request->all(),
            'active' => $active
        ]);
        return redirect()->route('tour.index')->with('success', 'Thêm tour thành công');
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
    public function edit(string $id)
    {
        $categoryTour = ProductCategory::all();
        $tour = ProductSchedule::find($id);
        return view('tour.edit', compact('tour', 'categoryTour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTourRequest $request, string $id)
    {
        $active = isset($request->active) ? 1 : 0;
        ProductSchedule::find($id)->update([
            ...$request->all(),
            'active' => $active
        ]);
        return redirect()->route('tour.index')->with('success', 'Cập nhật tour thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductSchedule::find($id)->delete();
        return redirect()->route('tour.index')->with('success', 'Xóa tour thành công');
    }
}

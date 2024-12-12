<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StartDate\StoreRequest;
use App\Models\StartPlace;
use Illuminate\Http\Request;

class StartPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startPlaces = StartPlace::all();
        return view('startPlace.index', compact('startPlaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('startPlace.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['active'] ??= 0;
        $data['hot'] ??= 0;
        StartPlace::create($data);
        return redirect()->route('startPlace.index')->with('success', 'Thêm mới thành công');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $startPlace = StartPlace::find($id);
        return view('startPlace.edit', compact('startPlace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['active'] ??= 0;
        $data['hot'] ??= 0;
        $startPlace = StartPlace::find($id);
        $startPlace->update($data);
        return redirect()->route('startPlace.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $startPlace = StartPlace::find($id);
        $startPlace->delete();
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TourtypeRequest\StoreRequest;
use App\Models\ProductCategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tourtypes = ProductCategoryType::whereNull('deleted_at')->get();
        return view('tourType.index', compact('tourtypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreRequest $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->input('image'));
            $param = $request->except('_token');
            // die();
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = uploadFile('TourType', $request->file('image'));
            }
            $tourtypes = ProductCategoryType::create($param);
            if ($tourtypes->id) {
                session()->flash('success', 'Thêm mới loại tour thành công');
                return redirect()->route('tourType.index');
            }
        }
        return view('tourType.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreRequest $request, $id)
    {
        $tourtypes = ProductCategoryType::find($id);
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $resultDl = Storage::delete('/public/' . $tourtypes->image);
                if ($resultDl) {
                    $param['image'] = uploadFile('TourType', $request->file('image'));
                }
            } else {
                $param['image'] = $tourtypes->image;
            }
            $result = ProductCategoryType::where('id', $id)
                ->update($param);
                if ($result) {
                    session()->flash('success', 'Cập nhật loại tour thành công');
                    return redirect()->route('tourType.index');
                }
        }
        return view('tourType.edit', compact('tourtypes'));
    }
    public function destroy(string $id)
    {
        ProductCategoryType::where('id', $id)->delete();
        session()->flash('success', 'Xóa loại tour thành công');
        return redirect()->route('tourType.index');
    }
}

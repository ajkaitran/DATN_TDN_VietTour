<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourType\TourTypeRequest;
use App\Models\TourType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TypetourCategory extends Controller
{
    public function index(Request $request)
    {
        $tourtypes = TourType::whereNull('deleted_at')->get();
        return view('typetour.index', compact('tourtypes'));
    }

    // public function add(){
    //     // die ('You must');
    //     return view('typetour.create');
    // }
    public function create(TourTypeRequest $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->input('name'));
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = uploadFile('hinh', $request->file('image'));
            }
            // dd();
            $tourtype = TourType::create($param);
            if ($tourtype->id) {
                Session::flash('success', 'Thêm mới danh mục thành công');
                return redirect()->route('typetour.index');
            }
        }
        return view('typetour.create');
    }
    public function edit(TourTypeRequest $request, $id) {
        $tourtype = TourType::find($id);
        // dd($tourtype);
        if($request->post()){
            $param = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $resultDl = Storage::delete('/public/'.$tourtype->image);
                if($resultDl){
                    $param['image'] = uploadFile('hinh', $request->file('image'));
                }
            }else{
                $param['image'] = $tourtype->image;
            }
            $result = TourType::where('id', $id)
            ->update($param);
            if($result){
                Session::flash('success', 'Cập nhật danh mục thành công');
                return redirect()->route('typetour.index');
            }
        }
        return view('typetour.edit', compact('tourtype'));
    }
    public function delete($id){
        TourType::where('id', $id)->delete();
        Session::flash('success', 'Xóa danh mục thành công');
        return redirect()->route('typetour.index');
    }
}

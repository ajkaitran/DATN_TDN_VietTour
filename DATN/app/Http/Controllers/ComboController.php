<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Combo\StoreComboRequest;
use App\Models\Itinerary;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
use App\Models\StartPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tourtype = ProductCategoryType::whereNull('deleted_at')->get();
        // $categories = ProductCategory::all();
        $combos = Product::whereNull('deleted_at')->get(); // Lấy danh sách combo tour
        return view('combo.index', compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function create(StoreComboRequest $request)
    {
        $tourtype = ProductCategoryType::whereNull('deleted_at')->get();
        $parentCategories = ProductCategory::whereNull('parent_id')->get(); // Danh mục cha
        $childCategories = ProductCategory::whereNotNull('parent_id')->get(); // Danh mục con
        $startplace = StartPlace::all();

        if ($request->isMethod('POST')) {
            $param = $request->except('_token'); // Lấy thông tin sản phẩm từ request

            // Xử lý ảnh (nếu có)
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = uploadFile('Combo', $request->file('image'));
            }

            // Tạo sản phẩm (combo tour)
            $product = Product::create($param);

            // Nếu tạo product thành công, thêm lịch trình
            if ($product->id) {
                // Lấy các trường lịch trình từ request và lưu vào bảng itineraries
                $itineraryNames = $request->input('TimeDetailName'); // Lấy các tiêu đề
                $itineraryBodies = $request->input('TimeDetailBody'); // Lấy các nội dung
                $totalDays = $request->input('TimeDetail'); // Lấy số ngày của tour

                // Lặp qua các ngày và tạo lịch trình tương ứng
                for ($day = 1; $day <= $totalDays; $day++) {
                    // Kiểm tra nếu có tiêu đề và nội dung cho ngày đó
                    if (!empty($itineraryNames[$day]) && !empty($itineraryBodies[$day])) {
                        // Lưu lịch trình cho ngày
                        $product->itineraries()->create([
                            'day' => $day, // Ngày
                            'title' => $itineraryNames[$day], // Tiêu đề
                            'description' => $itineraryBodies[$day], // Nội dung
                        ]);
                    }
                }

                session()->flash('success', 'Combo created successfully');
                return redirect()->route('combo.index');
            }

            session()->flash('error', 'Error creating Combo');
            return back();
        }

        // Trả về view tạo mới combo với dữ liệu danh mục tour và loại tour
        return view('combo.create', compact('parentCategories', 'childCategories', 'tourtype', 'startplace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreComboRequest $request, $id)
    {
        $combos = Product::find($id);
        $categories = ProductCategory::all();
        $types = ProductCategoryType::all();
        $startPlaces = StartPlace::all();
        $itineraries = Itinerary::where('product_id', $id)->orderBy('day')->get();
    
        if ($request->post()) {
            $param = $request->except('_token'); // Lấy tất cả dữ liệu, trừ _token
    
            // Loại bỏ các trường TimeDetail, TimeDetailName, TimeDetailBody
            unset($param['TimeDetail'], $param['TimeDetailName'], $param['TimeDetailBody']);
    
            // Xử lý hình ảnh
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $resultDl = Storage::delete('/public/' . $combos->image);
                if ($resultDl) {
                    $param['image'] = uploadFile('Combo', $request->file('image'));
                }
            } else {
                $param['image'] = $combos->image;
            }
    
            // Cập nhật thông tin Combo
            $result = Product::where('id', $id)->update($param);
    
            // Lưu lịch trình
            $selectedDays = $request->input('TimeDetail', 0);
    
            for ($i = 1; $i <= $selectedDays; $i++) {
                $title = $request->input("TimeDetailName.$i");
                $description = $request->input("TimeDetailBody.$i");
    
                // Tìm hoặc tạo mới lịch trình
                Itinerary::updateOrCreate(
                    ['product_id' => $id, 'day' => $i],
                    ['title' => $title, 'description' => $description]
                );
            }
    
            // Xóa lịch trình thừa nếu số ngày giảm
            Itinerary::where('product_id', $id)
                ->where('day', '>', $selectedDays)
                ->delete();
    
            // Hiển thị thông báo và quay lại trang danh sách
            if ($result) {
                session()->flash('success', 'Sửa phản hồi thành công');
                return redirect()->route('combo.index');
            }
        }
    
        return view('combo.edit', compact('combos', 'categories', 'types', 'startPlaces', 'itineraries'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        Itinerary::where('product_id', $id)->delete();
        session()->flash('success', 'Xóa combo thành công ');
        return redirect()->route('combo.index');
    }
}

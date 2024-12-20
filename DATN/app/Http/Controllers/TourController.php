<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Tour\StoreTourRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
use App\Models\ProductSchedule;
use App\Models\StartPlace;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Product::whereNull('deleted_at')->get(); // Lấy danh sách tour tour
        $parentCategories = ProductCategory::whereNull('parent_id')->get(); // Danh mục cha
        $childCategories = ProductCategory::whereNotNull('parent_id')->get(); // Danh mục con
        return view('tour.index', compact('tours','parentCategories', 'childCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tourtype = ProductCategoryType::whereNull('deleted_at')->get();
        $parentCategories = ProductCategory::whereNull('parent_id')->get(); // Danh mục cha
        $childCategories = ProductCategory::whereNotNull('parent_id')->get(); // Danh mục con
        $startplace = StartPlace::all();

        if ($request->isMethod('POST')) {
            $param = $request->except('_token'); // Lấy thông tin sản phẩm từ request

            // Xử lý ảnh (nếu có)
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $param['image'] = uploadFile('Anh_Tour', $request->file('image'));
            }

            // Tạo sản phẩm (tour tour)
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

                session()->flash('success', 'tour created successfully');
                return redirect()->route('tour.index');
            }

            session()->flash('error', 'Error creating tour');
            return back();
        }

        // Trả về view tạo mới tour với dữ liệu danh mục tour và loại tour
        return view('tour.create', compact('parentCategories', 'childCategories', 'tourtype', 'startplace'));
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Tour\StoreTourRequest;
use App\Models\Article;
use App\Models\Itinerary;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
use App\Models\ProductSchedule;
use App\Models\StartPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query(); // Khởi tạo query

        // Lọc theo tên tour
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo loại tour
        if ($request->filled('category_type_id')) {
            $query->where('category_type_id', $request->category_type_id);
        }

        // Lọc theo danh mục cha
        if ($request->filled('main_category_id')) {
            $query->where('main_category_id', $request->main_category_id);
        }
        // Lọc theo danh mục con
        if ($request->filled('product_category_id')) {
            $query->where('product_category_id', $request->product_category_id);
        }

        $tours = $query->paginate(5)->appends($request->all());

        // Lấy các danh mục và loại tour
        $ProductCategories = ProductCategory::all();
        $parentCategories = ProductCategory::whereNull('parent_id')->get();
        $childCategories = ProductCategory::whereNotNull('parent_id')->get();
        $tourtypes = ProductCategoryType::all();

        return view('tour.index', compact('tours', 'ProductCategories', 'parentCategories', 'childCategories', 'tourtypes'));
    }


    public function create(StoreTourRequest $request)
    {
        $tourtype = ProductCategoryType::whereNull('deleted_at')->get();
        $parentCategories = ProductCategory::whereNull('parent_id')->get(); // Danh mục cha
        $childCategories = ProductCategory::whereNotNull('parent_id')->get(); // Danh mục con
        $articles = Article::all();
        // $selectedArticles = $tours->articles->pluck('id')->toArray(); 
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

                session()->flash('success', 'tthêm mới tour thành công');
                return redirect()->route('tour.index');
            }

            session()->flash('error', 'Thêm mới tour bị lỗi');
            return back();
        }

        // Trả về view tạo mới tour với dữ liệu danh mục tour và loại tour
        return view('tour.create', compact('parentCategories', 'childCategories', 'tourtype', 'startplace', 'articles'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreTourRequest $request, $id)
    {
        $tours = Product::find($id);
        // $category = ProductCategory::findOrFail($id); // Lấy danh mục cần chỉnh sửa
        $parentCategories = ProductCategory::whereNull('parent_id')->get(); // Danh mục cha
        $childCategories = ProductCategory::whereNotNull('parent_id')->get(); // Danh mục con
        $types = ProductCategoryType::all();
        $startPlaces = StartPlace::all();
        $articles = Article::all();
        $itineraries = Itinerary::where('product_id', $id)->orderBy('day')->get();

        if ($request->post()) {
            $param = $request->except('_token'); // Lấy tất cả dữ liệu, trừ _token

            // Loại bỏ các trường TimeDetail, TimeDetailName, TimeDetailBody
            unset($param['TimeDetail'], $param['TimeDetailName'], $param['TimeDetailBody']);

            // Xử lý hình ảnh
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $resultDl = Storage::delete('/public/' . $tours->image);
                if ($resultDl) {
                    $param['image'] = uploadFile('Anh_Tour', $request->file('image'));
                }
            } else {
                $param['image'] = $tours->image;
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
                session()->flash('success', 'Sửa tour thành công');
                return redirect()->route('tour.index');
            }
        }

        return view('tour.edit', compact('tours', 'parentCategories', 'childCategories', 'types', 'startPlaces', 'itineraries', 'articles'));
    }

    public function quickUpdate(Request $request)
    {
        $id = $request->input('id');
        $sale_off = $request->input('sale_off');
        $price = $request->input('price');
        $hot = $request->input('hot');
        $home_page = $request->input('home_page');
        $active = $request->input('active');

        $tour = Product::find($id);
        if ($tour) {
            $tour->sale_off = $sale_off;
            $tour->price = $price;
            $tour->hot = $hot;
            $tour->home_page = $home_page;
            $tour->active = $active;
            $tour->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        Itinerary::where('product_id', $id)->delete();
        session()->flash('success', 'Xóa tour thành công ');
        return redirect()->route('tour.index');
    }
}

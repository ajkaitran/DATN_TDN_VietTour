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
    public function index()
    {
        $tours = Product::whereNull('deleted_at')->get(); // Lấy danh sách tour tour
        $ProductCategories = ProductCategory::all(); // Danh mục cha
        // $childCategories = ProductCategory::whereNotNull('parent_id')->get(); // Danh mục con
        return view('tour.index', compact('tours', 'ProductCategories'));
    }
    public function listTour()
    {   
        
        $items = Product::all(); // Lấy tất cả các mục từ cơ sở dữ liệu
        // $ProductCategories = ProductCategory::all(); // Danh mục cha
        return response()->json($items); // Trả về dữ liệu dưới dạng JSON
    }
    public function getTourByCategory($cateID){
        $tours = Product::where('category_type_id', $cateID)->get();
        if ($tours->isEmpty()) {
            return response()->json(['message' => 'Tours không tồn tại trong category_type_id'], 404);
        }

        return response()->json(['products' => $tours], 200);
    }
    public function getToursById($id)
    {
        $tour = Product::where('id', $id)->get();
        if ($tour->isEmpty()) {
            return response()->json(['message' => 'Tours không tồn tại'], 404);
        }

        return response()->json(['products' => $tour], 200);
    }
    //Search Tour theo tên
    public function searchByName(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->input('keyword');
        
        // Tìm kiếm sản phẩm theo tên
        $tours = Product::where('name', 'like', '%'.$keyword.'%')->get();

        // Trả về kết quả tìm kiếm
        return response()->json($tours);
    }
    /**
     * Show the form for creating a new resource.
     */
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

                session()->flash('success', 'tour created successfully');
                return redirect()->route('tour.index');
            }

            session()->flash('error', 'Error creating tour');
            return back();
        }

        // Trả về view tạo mới tour với dữ liệu danh mục tour và loại tour
        return view('tour.create', compact('parentCategories', 'childCategories', 'tourtype', 'startplace','articles'));
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
                    $param['image'] = uploadFile('Combo', $request->file('image'));
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
                session()->flash('success', 'Sửa phản hồi thành công');
                return redirect()->route('tour.index');
            }
        }

        return view('tour.edit', compact('tours', 'parentCategories', 'childCategories', 'types', 'startPlaces', 'itineraries','articles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        Itinerary::where('product_id', $id)->delete();
        session()->flash('success', 'Xóa tour thành công ');
        return redirect()->route('tour.index');
    }
}

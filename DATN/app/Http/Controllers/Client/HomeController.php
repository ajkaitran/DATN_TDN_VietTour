<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
use App\Models\Product;
use App\Models\Order;
use App\Models\StartPlace;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Requests\Admin\User\RegisterRequest;
use App\Models\ArticleCategory;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index()
    {
        $objBanner = new Banner();
        $objTourCate = new ProductCategory();
        $objTour = new Product();
        $objArticle = new Article();
        $objFeedback = new Feedback();
        $this->view['listBanner1'] = $objBanner->where('banner_group', 1)->where('active', 1)->get();
        $this->view['listBanner2'] = $objBanner->where('banner_group', 2)->where('active', 1)->get();
        $this->view['listBanner3'] = $objBanner->where('banner_group', 3)->where('active', 1)->get();
        $this->view['listBanner4'] = $objBanner->where('banner_group', 4)->where('active', 1)->get();
        $this->view['listBanner5'] = $objBanner->where('banner_group', 5)->where('active', 1)->get();
        $this->view['listCate1'] = $objTourCate->where('type', 1)->where('active', 1)->get();
        $this->view['listCate2'] = $objTourCate->where('type', 2)->where('active', 1)->get();
        $this->view['listTourHome'] = $objTour->where('home_page', 1)->where('active', 1)->take(8)->get();
        $this->view['listTourCombo'] = $objTour->where('category_type_id', 3)->where('home_page', 1)->where('active', 1)->take(8)->get();
        $this->view['listArticleHot'] = $objArticle->where('active', 1)->where('hot', 1)->with('articleCategory')->get();
        $this->view['relatedArticles'] = $objArticle->whereIn('article_category_id', $this->view['listArticleHot']->keys())->where('active', 1)->take(2)->get();
        $this->view['listFeedback'] = $objFeedback->where('type', 0)->where('active', 1)->get();
        $this->view['listFeedback2'] = $objFeedback->where('type', 1)->where('active', 1)->get();

        return view('home.index', $this->view);
    }
    public function tour()
    {
        $objTour = new Product();
        $objType = new ProductCategoryType();
        $this->view['listTypes'] = $objTour->where('active', 1)->paginate(5);
        $this->view['listTours'] = $objTour->where('active', 1)->paginate(5);
        return view('home.tour', $this->view);
    }
    public function searchTour(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->input('keyword');

        // Tìm kiếm sản phẩm theo tên
        $items = Product::where('name', 'like', '%' . $keyword . '%')->paginate(8);
        // Trả về kết quả tìm kiếm
        return view('home.searchTour', compact('items'));
    }
    public function tourLog(Request $request, $id)
    {  
        $objBanner = new Banner();
        $category_type = ProductCategory::findOrFail($id);
        $objTourCate = new ProductCategory();
        $starts = StartPlace::all();
        $query = Product::query();
        $objTourType = new ProductCategoryType();
        $this->view['listBanner6'] = $objBanner->where('banner_group', 6)->where('active', 1)->get();
        $this->view['listType'] = $objTourType->where('show_menu', 1)->where('active', 1)->get();
        $this->view['categoriesByType'] = $objTourType->with(['categories' => function ($query) {
            $query->where('active', 1);
        }])->get();
        $query->where(function ($q) use ($id) {
            $q->where('product_category_id', $id)
                ->orWhere('main_category_id', $id);
        });
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->has('type') && is_array($request->type)) {
            $query->whereIn('category_type_id', $request->type);
        }

        // Lọc theo điểm đi (nếu có)
        if ($request->has('from') && $request->from != '') {
            $query->where('start_places_id', $request->from); // Đảm bảo `start_id` là tên cột đúng
        }
        // Lấy kết quả
        $tours = $query->paginate(6);
        // Trả dữ liệu về view
        return view('home.tourLog', compact('tours', 'category_type', 'starts'),$this->view);
    }
    public function getToursByCategory($category_type_id)
    {
        $tours = Product::where('category_type_id', $category_type_id)->paginate(8);
        $category = ProductCategoryType::findOrFail($category_type_id);
        return view('home.tourByCate', compact('tours', 'category'));
    }
    public function detail($id)
    {
        // Lấy thông tin sản phẩm
        $item = Product::with('itineraries')->findOrFail($id);
        $otherTours = Product::where('id', '!=', $id)->take(5)->get();

        // Trả về view kèm dữ liệu
        return view('home.detail', compact('item', 'otherTours'));
    }
    public function blog(Request $request)
    {
        // Lấy tất cả bài viết và thể loại bài viết
        $blog = Article::with('articleCategory');
        $articleCategory = ArticleCategory::all();

        // Kiểm tra nếu có tham số tìm kiếm
        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            // Tìm kiếm theo tên bài viết (subject), mô tả (description), hoặc tên thể loại bài viết (category_name)
            $blog = $blog->where(function ($query) use ($searchTerm) {
                $query->where('subject', 'LIKE', "%$searchTerm%")
                    ->orWhere('description', 'LIKE', "%$searchTerm%")
                    ->orWhereHas('articleCategory', function ($query) use ($searchTerm) {
                        $query->where('category_name', 'LIKE', "%$searchTerm%");
                    });
            });
        }

        // Phân trang kết quả tìm kiếm hoặc tất cả bài viết
        $blog = $blog->where('active', 1)->paginate(6);

        return view('home.blog', compact('blog', 'articleCategory'));
    }
    public function about()
    {
        return view('home.about');
    }
    public function order()
    {
        return view('home.order');
    }
    public function orderTour($id)
    {
        $this->view['user'] = auth()->user();
        $tour = Product::findOrFail($id);
        return view('home.order', compact('tour'),$this->view);
    }
    public function storeOrder(Request $request)
    {
        $objOrder = new Order();
        $res = $objOrder->insertDataOrder($request->all());
        if ($res) {
            return redirect()->back()->with('success', 'Đặt tour thành công!');
        } else {
            return redirect()->back()->with('error', 'Đặt tour không thành công!');
        }
    }

    public function register()
    {
        return view('home.modal.register');
    }
    public function postRegister(RegisterRequest  $request)
    {
        $objAdmin = new User();
        $request->merge(['password' => Hash::make($request->password)]);
        $res = $objAdmin->insertDataClient($request->all());
        if ($res) {
            return redirect()->back()->with('success', 'Đăng ký tài khoản thành công!');
        } else {
            return redirect()->back()->with('error', 'Đăng ký tài khoản không thành công!');
        }
    }
    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('AnhTaiKhoan', $fileName, 'public');
    }
    public function login()
    {
        return view('home.modal.login');
    }
    public function postLogin(LoginRequest $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $login, 'password' => $password])) {
            $user = Auth::user();
            if ($user->status != 1) {
                Auth::logout();
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được kích hoạt.');
            }
            if (!in_array($user->role, [2, 3, 4])) {
                Auth::logout();
                return redirect()->back()->with('error', 'Tài khoản không tồn tại.');
            }
            return redirect()->route('home.index');
        } else {
            return redirect()->back()
                ->with('error', 'Tài khoản hoặc mật khẩu không chính xác.')
                ->withInput($request->only('login'));
        }
    }

    public function signout(Request $request)
    {
        if (Auth::check()) {
            Log::info('User logged out', ['user_id' => Auth::id(), 'ip' => $request->ip()]);
            Auth::logout();
            return redirect()->route('home.index')->with('success', 'Bạn đã đăng xuất thành công!');
        }

        return redirect()->route('home.index')->with('error', 'Bạn chưa đăng nhập!');
    }
}

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
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Requests\Admin\User\RegisterRequest;
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
    public function index(){
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
    public function tour(){
        return view('home.tour');
    }
    public function searchTour(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->input('keyword');

        // Tìm kiếm sản phẩm theo tên
        $items = Product::where('name', 'like', '%' . $keyword . '%')->get();
        // Trả về kết quả tìm kiếm
        return view('home.searchTour',compact('items'));
    }
    public function order()
    {
        return view('home.order');
    }
    public function orderTour($id)
    {
        $tour = Product::findOrFail($id);
        return view('home.order', compact('tour'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'oder_code' => 'required|string|max:255',
            'payment' => 'required|string|max:255',
            'transport_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'customer_info_full_name' => 'required|string|max:255',
            'customer_info_address' => 'required|string|max:255',
            'customer_info_email' => 'required|email',
            'customer_info_phone' => 'required|string|max:15',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        Order::create($request->all());
        // Gửi thông báo thành công qua session
        return redirect()->back()->with('success', 'Đặt tour thành công!');
    }

    public function tourLog()
    {
        return view('home.tourLog');
    }
    public function getToursByCategory($category_type_id)
    {
        $tours = Product::where('category_type_id', $category_type_id)->get();
        $category = ProductCategoryType::findOrFail($category_type_id);
        return view('home.tourByCate', compact('tours','category'));
    }
    public function blog()
    {
        return view('home.blog');
    }
    public function register()
    {
        return view('home.modal.register');
    }
    public function detail($id)
    {
        // Lấy thông tin sản phẩm
        $item = Product::with('itineraries')->findOrFail($id);
        $otherTours = Product::where('id', '!=', $id)->take(5)->get();

        // Trả về view kèm dữ liệu
        return view('home.detail', compact('item','otherTours'));
    }

    public function about()
    {
        return view('home.about');
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

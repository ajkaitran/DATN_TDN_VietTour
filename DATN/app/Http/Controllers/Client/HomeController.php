<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Requests\Admin\User\RegisterRequest;
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
        $this->view['listBanner1'] = $objBanner->where('banner_group', 1)->where('active', 1)->get();
        $this->view['listBanner2'] = $objBanner->where('banner_group', 2)->where('active', 1)->get();
        $this->view['listBanner3'] = $objBanner->where('banner_group', 3)->where('active', 1)->get();
        $this->view['listBanner4'] = $objBanner->where('banner_group', 4)->where('active', 1)->get();
        $this->view['listBanner5'] = $objBanner->where('banner_group', 5)->where('active', 1)->get();
        $this->view['listCate1'] = $objTourCate->where('type', 1)->where('active', 1)->get();
        $this->view['listCate2'] = $objTourCate->where('type', 2)->where('active', 1)->get();
        $this->view['listTourHome'] = $objTour->where('home_page', 1)->where('active', 1)->get();
        $this->view['listTourCombo'] = $objTour->where('category_type_id', 3)->where('home_page', 1)->where('active', 1)->get();
        $this->view['listArticleHot'] = $objArticle->where('active', 1)->where('hot', 1)->get()->groupBy('article_category_id');;
        return view('home.index', $this->view);
    }
    public function tour(){
        return view('home.tour');
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

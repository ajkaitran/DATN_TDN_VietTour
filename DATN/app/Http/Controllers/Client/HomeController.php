<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
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
        $this->view['listBanner1'] = $objBanner->where('banner_group', 1)->get();
        $this->view['listBanner2'] = $objBanner->where('banner_group', 2)->get();
        $this->view['listBanner3'] = $objBanner->where('banner_group', 3)->get();
        $this->view['listBanner4'] = $objBanner->where('banner_group', 4)->get();
        return view('home.index', $this->view);
    }
    public function tour(){
        return view('home.tour');
    }
    public function searchTour()
    {
        return view('home.searchTour');
    }
    public function order()
    {
        return view('home.order');
    }
    public function register()
    {
        return view('home.modal.register');
    }
    public function detail()
    {
        return view('home.detail');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Requests\Admin\User\RegisterRequest;
use App\Http\Requests\Admin\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index()
    {
        return view('admin.index');
    }
    public function register()
    {
        $objAdmin = new User();
        $this->view['listAdmin'] = $objAdmin->loadListAdmin();

        $this->view['roles'] = [
            0 => 'Admin',
            1 => 'Quản lý',
            2 => 'Nhân viên',
            3 => 'Thành viên',
            4 => 'Khách hàng',
        ];

        return view('admin.register', $this->view);
    }

    public function postRegister(RegisterRequest  $request)
    {
        $objAdmin = new User();
        if ($request->role == 0 && User::where('role', 0)->exists()) {
            return redirect()->back()->with('error', 'Tài khoản có quyền admin đã tồn tại!');
        }
        $request->merge(['password' => Hash::make($request->password)]);
        $res = $objAdmin->insertDataAdmin($request->all());
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
        return view('admin.login');
    }
    public function postLogin(LoginRequest $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $login, 'password' => $password])) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()
                ->with('error', 'Tài khoản hoặc mật khẩu không chính xác.')
                ->withInput($request->only('login'));
        }
    }
    public function changePassword()
    {
        return view('admin.changePassword');
    }

    public function postChange(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác!']);
        }

        $admin = Auth::user();
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công');
    }
    public function quickUpdate(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Người dùng không tồn tại!']);
        }

        $user->role = $request->role;
        $user->status = $request->status ? 1 : 0;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
    }
    public function destroy(string $id)
    {
        $objAdmin = new User();
        $user = $objAdmin->loadIdUser($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy ID tài khoản.');
        }
        $imagePath = $user->image;
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $isDeleted = $objAdmin->deleteDataUser($id);
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Xóa tài khoản thành công.');
        } else {
            return redirect()->back()->with('error', 'Xóa tài khoản không thành công.');
        }
    }

    public function signout(Request $request)
    {
        if (Auth::check()) {
            Log::info('User logged out', ['user_id' => Auth::id(), 'ip' => $request->ip()]);
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất thành công!');
        }

        return redirect()->route('admin.login')->with('error', 'Bạn chưa đăng nhập!');
    }
}

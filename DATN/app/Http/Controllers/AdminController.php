<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Requests\Admin\User\RegisterRequest;
use App\Http\Requests\Admin\User\ChangePasswordRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
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
    public function listUser()
    {
        $objAdmin = new User();
        $this->view['listAdmin'] = $objAdmin->loadListUser();

        $this->view['roles'] = [
            2 => 'Thành viên',
            3 => 'Khách hàng',
        ];

        return view('admin.listUser', $this->view);
    }
    public function listClient()
    {
        $objAdmin = new User();
        $this->view['listAdmin'] = $objAdmin->loadListClient();

        $this->view['roles'] = [
            2 => 'Thành viên',
            3 => 'Khách hàng',
        ];

        return view('admin.listClient', $this->view);
    }
    public function listOrder(Request $request)
    {
        $objClient = new User();
        $query = Product::query(); // Khởi tạo query
        $objOrder = new Order();

        // Lọc theo tên tour
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $tours = $query->paginate(5);
        $this->view['listOrder'] = $objOrder->with('product')->paginate(5);
        $this->view['users'] = $objClient->get();
        $this->view['payments'] = [
            1 => 'Thanh Toán Trực Tuyến',
            2 => 'Thanh Toán Momo',
        ];
        $this->view['status'] = [
            1 => 'Chưa Thanh Toán',
            2 => 'Đã Thanh Toán',
            3 => 'Dã Hủy',
        ];

        return view('admin.listOrder', compact('tours'), $this->view);
    }
    public function quickUpdateOrder(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $user = User::find($id);
        if ($user) {
            $user->status = $status;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function register()
    {
        $objAdmin = new User();
        $this->view['listAdmin'] = $objAdmin->loadListAdmin();

        $this->view['roles'] = [
            1 => 'Quản lý',
            2 => 'Thành viên',
            3 => 'Khách hàng',
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
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }
    public function login()
    {
        return view('admin.login');
    }
    public function postLogin(LoginRequest $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
    
        // Xác định trường cần dùng để đăng nhập: email hoặc username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Nếu không đăng nhập được với guard 'web', thử đăng nhập với guard 'admin'
        if (Auth::guard('admin')->attempt([$field => $login, 'password' => $password])) {
            $admin = Auth::guard('admin')->user();
    
            // Kiểm tra trạng thái của tài khoản Admin
            if ($admin->status != 1) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được kích hoạt.');
            }
            if (!in_array($admin->role, [0, 1])) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Bạn không có quyền truy cập.');
            }
            return redirect()->route('admin.index');
        }
        return redirect()->back()
            ->with('error', 'Tài khoản hoặc mật khẩu không chính xác.')
            ->withInput($request->only('login'));
    }
    
    public function changePassword()
    {
        return view('admin.changePassword');
    }

    public function postChange(ChangePasswordRequest $request)
{
    if (Auth::check() && Auth::user()->role == 0) {
        $user = User::find($request->user_id);

        if (!$user) {
            return back()->withErrors(['error' => 'Người dùng không tồn tại!']);
        }

        // Kiểm tra mật khẩu hiện tại của người dùng Admin
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác!']);
        }

        // Kiểm tra xem mật khẩu mới có trùng với mật khẩu cũ không
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'Mật khẩu mới không thể trùng với mật khẩu cũ của người dùng!']);
        }

        try {
            // Cập nhật mật khẩu của người dùng khác
            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', 'Mật khẩu của người dùng đã được thay đổi thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại!']);
        }
    } else {
        // Nếu người dùng không phải admin, chỉ cho phép thay đổi mật khẩu của chính họ
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác!']);
        }

        // Kiểm tra mật khẩu mới có trùng với mật khẩu cũ không
        if (Hash::check($request->new_password, Auth::user()->password)) {
            return back()->withErrors(['new_password' => 'Mật khẩu mới không thể trùng với mật khẩu cũ!']);
        }

        try {
            // Cập nhật mật khẩu của người dùng hiện tại
            $admin = Auth::user();
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return back()->with('success', 'Mật khẩu đã được thay đổi thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại!']);
        }
    }
}


    public function edit(int $id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $objTable = new User();
        $idCheck = $objTable->loadIdUser($id);

        if ($idCheck) {
            $data = $request->except(['image']);
            // Xử lý `image`
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $data['image'] = $this->uploadFile($request->file('image'));
                $imageOld = $idCheck->image;
            } else {
                $data['image'] = $idCheck->image;
            }
            $res = $objTable->updateDataUser($data, $id);

            if ($res) {
                // Xóa file cũ `image` nếu có
                if ($request->hasFile('image') && isset($imageOld) && Storage::disk('public')->exists($imageOld)) {
                    Storage::disk('public')->delete($imageOld);
                }
                return redirect()->back()->with('success', 'Chỉnh sửa thành công');
            } else {
                return redirect()->back()->with('error', 'Chỉnh sửa không thành công');
            }
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy id');
        }
    }
    public function quickUpdate(Request $request)
    {
        $id = $request->input('id');
        $role = $request->input('role');
        $status = $request->input('status');

        $user = User::find($id);
        if ($user) {
            $user->role = $role;
            $user->status = $status;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function destroy(string $id)
    {
        $objAdmin = new User();
        $user = $objAdmin->loadIdUser($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy ID tài khoản.');
        }

        // Xóa hình ảnh nếu có
        $imagePath = $user->image;
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        // Kiểm tra nếu đang xóa tài khoản đăng nhập hiện tại
        if (Auth::id() == $id) {
            // Đăng xuất tài khoản
            Auth::logout();
            $objAdmin->deleteDataUser($id);

            return redirect()->route('admin.login')->with('info', 'Tài khoản của bạn đã bị xóa. Bạn đã bị đăng xuất.');
        }

        // Xóa tài khoản khác
        $isDeleted = $objAdmin->deleteDataUser($id);
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Xóa tài khoản thành công.');
        } else {
            return redirect()->back()->with('error', 'Xóa tài khoản không thành công.');
        }
    }
    public function signout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            Log::info('Admin logged out', [
                'admin_id' => $admin->id,
                'role' => $admin->role,
                'ip' => $request->ip(),
            ]);

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất thành công!');
        }

        return redirect()->route('admin.login')->with('error', 'Bạn chưa đăng nhập!');
    }
}

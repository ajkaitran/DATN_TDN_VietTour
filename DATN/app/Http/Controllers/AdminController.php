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
use App\Models\Comment;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Feedback;
use App\Models\ProductCategoryType;
use Carbon\Carbon;
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
        $today = Carbon::now();

        // Cập nhật trạng thái "Đang thực hiện" cho đơn hàng
        Order::where('status', 3) // 1: Chưa bắt đầu
            ->whereDate('transport_date', '<=', $today)
            ->whereDate('return_date', '>=', $today)
            ->update(['status' => 4]); // 2: Đang thực hiện

        // Cập nhật trạng thái "Hoàn thành" cho đơn hàng
        Order::where('status', 4) // 2: Đang thực hiện
            ->whereDate('return_date', '<', $today)
            ->update(['status' => 5]); // 3: Hoàn thành

        $userCount = User::where('role', '2')->count();
        $adminCount = User::whereIn('role', [0, 1])->count();
        $productCount = Product::count();
        $orderCount = Order::count();
        $commentCount = Comment::count();
        $articleCount = Article::count();
        $feedbackCount = Feedback::count();
        return view('admin.index', compact('userCount', 'adminCount', 'productCount', 'orderCount', 'commentCount', 'articleCount', 'feedbackCount'));
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
    // hiện thị danh sách đon hàng 
    public function listOrder(Request $request)
    {

        $objClient = new User();
        $query = Order::query()->with('product')->orderBy('created_at', 'desc'); // Query từ bảng Order và liên kết với bảng Product

        // Lọc theo tên khách hàng
        if ($request->filled('customer_name')) {
            $query->where('customer_info_full_name', 'like', '%' . $request->customer_name . '%');
        }

        // Lọc theo tên tour
        if ($request->filled('tour_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->tour_name . '%');
            });
        }

        // Lọc theo mã đơn hàng
        if ($request->filled('order_code')) {
            $query->where('oder_code', 'like', '%' . $request->order_code . '%');
        }

        // Lọc theo phương thức thanh toán
        if ($request->filled('payment_method')) {
            $query->where('payment', $request->payment_method);
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lấy danh sách đơn hàng sau khi lọc
        $listOrder = $query->paginate(5)->appends($request->all());

        // Chuẩn bị dữ liệu cho view
        $this->view['listOrder'] = $listOrder;
        $this->view['users'] = $objClient->get();
        $this->view['payments'] = [
            1 => 'Thanh Toán Trực Tuyến',
            2 => 'Thanh Toán Momo',
        ];
        $this->view['status'] = [
            1 => 'Chưa Thanh Toán',
            2 => 'Thanh Toán Thành Công',
            3 => 'Đã Xác Nhận',
            4 => 'Đang thực hiện',
            5 => 'Đã hoàn thành',
            6 => 'Đã hủy',
        ];

        return view('admin.listOrder', $this->view);
    }
    public function quickUpdateOrder(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $order = Order::find($id);
        if ($order) {
            $order->status = $status;
            $order->save();

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
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$field => $login, 'password' => $password])) {
            $admin = Auth::user();

            if ($admin->status != 1) {
                Auth::logout();
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được kích hoạt.');
            }
            if (!in_array($admin->role, [0, 1])) {
                Auth::logout();
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
        if (Auth::check()) {
            Log::info('User logged out', ['user_id' => Auth::id(), 'ip' => $request->ip()]);
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất thành công!');
        }

        return redirect()->route('admin.login')->with('error', 'Bạn chưa đăng nhập!');
    }
}

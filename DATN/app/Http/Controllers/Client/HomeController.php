<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ChangePasswordRequest;
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
use App\Models\Assess;
use App\Models\Comment;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

        if ($request->has('from') && $request->from != '') {
            $query->where('start_places_id', $request->from);
        }
        $tours = $query->paginate(6);

        return view('home.tourLog', compact('tours', 'category_type', 'starts'), $this->view);
    }
    public function getToursByCategory($category_type_id)
    {
        $tours = Product::where('category_type_id', $category_type_id)->where('active', 1)->paginate(8);
        $category = ProductCategoryType::findOrFail($category_type_id);
        return view('home.tourByCate', compact('tours', 'category'));
    }
    public function getBlogById($id)
    {
        $article = Article::with('articleCategory')->findOrFail($id);
        $comments = Comment::where('article_id', $id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $relatedArticles = Article::where('article_category_id', $article->article_category_id)
            ->where('id', '!=', $id)
            ->take(5)
            ->get();
        return view('home.blogDetail', compact('article', 'relatedArticles', 'comments'));
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
        $blog = $blog->where('active', 1)->paginate(6)->appends($request->all());

        return view('home.blog', compact('blog', 'articleCategory'));
    }
    public function about()
    {
        return view('home.about');
    }
    public function profile()
    {
        $user = auth()->user();
        $objOrder = new Order();
        $this->view['listOrder'] = $objOrder->with('product')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $this->view['payments'] = [
            1 => 'Thanh Toán Trực Tuyến',
            2 => 'Thanh Toán Momo',
        ];
        $this->view['status'] = [
            1 => 'Chưa Thanh Toán',
            2 => 'Chờ xử lý',
            3 => 'Thanh toán thành công',
            4 => 'Tour đang được diễn ra',
            5 => 'Tour đã hoàn thành',
            6 => 'Tour đã hủy',
        ];
        return view('home.profile', compact('user'), $this->view);
    }
    public function updateUser(Request $request, $id)
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
    public function orderDetail(){
        $objClient = new User();
        $listOrder = new Order();
        $this->view['Order'] = $listOrder->with('product')->get();
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

        return view('home.modal.orderDetail', $this->view);
    }
    public function orderTour($id)
    {
        $this->view['user'] = auth()->user();
        $tour = Product::findOrFail($id);
        return view('home.order', compact('tour'), $this->view);
    }
    public function storeOrder(Request $request)
    {
        // Lấy dữ liệu từ form
        $params = $request->all();

        // Tạo mã đơn hàng
        $params['oder_code'] = 'ODR-' . strtoupper(uniqid()); // Tạo mã đơn hàng ngẫu nhiên

        // Thiết lập giá trị mặc định cho trường 'viewed'
        $params['viewed'] = 0;  // Mặc định là chưa xem (0)

        // Tìm tour dựa trên product_id
        $tour = Product::find($params['product_id']);

        if ($tour) {
            // Lấy số lượng lịch trình của tour
            $daysInTour = $tour->itineraries->count();

            // Tính ngày kết thúc
            $startDate = Carbon::parse($params['transport_date']);
            $endDate = $startDate->addDays($daysInTour - 1);

            // Thêm ngày kết thúc vào params
            $params['return_date'] = $endDate;
            $params['status'] = 1;
            $params['payment'] = 1;
            $params['user_id'] = auth()->id(); // Người dùng đang đăng nhập

            // Lưu đơn hàng vào cơ sở dữ liệu
            $order = Order::create($params);

            if ($order) {
                return redirect()->route('home.profile')->with('success', 'Đặt tour thành công!');
            } else {
                return redirect()->back()->with('error', 'Đặt tour không thành công!');
            }
        }

        return redirect()->back()->with('error', 'Tour không hợp lệ!');
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
    public function checkout()
    {
        return view('home.modal.checkout');
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
            if (!in_array($user->role, [2, 3])) {
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
    public function signout(Request $request)
    {
        if (Auth::check()) {
            Log::info('User logged out', ['user_id' => Auth::id(), 'ip' => $request->ip()]);
            Auth::logout();
            return redirect()->route('home.index')->with('success', 'Bạn đã đăng xuất thành công!');
        }

        return redirect()->route('home.index')->with('error', 'Bạn chưa đăng nhập!');
    }

    public function statistics(Request $request)
    {
        $year = $request->input('year', now()->year);


        // Thống kê theo tháng
        $monthlyStatistics = Order::select(

            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as pending_orders'),
            DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as paid_orders'),
            DB::raw('SUM(CASE WHEN status = 1 THEN price * quantity ELSE 0 END) as total_pending'),
            DB::raw('SUM(CASE WHEN status = 2 THEN price * quantity ELSE 0 END) as total_paid')
        )
            ->whereYear('created_at', $year)
            ->whereNotIn('status', [3])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $monthlyStatistics = collect(range(1, 12))->map(function ($month) use ($monthlyStatistics) {
            $data = $monthlyStatistics->firstWhere('month', $month);
            return [
                'month' => $month,
                'total_orders' => $data->total_orders ?? 0,
                'pending_orders' => $data->pending_orders ?? 0,
                'paid_orders' => $data->paid_orders ?? 0,
                'total_pending' => $data->total_pending ?? 0,
                'total_paid' => $data->total_paid ?? 0,
            ];
        });

        // Thống kê theo ngày
        $dailyStatistics = $this->dailyStatistics($year);

        return view('admin.orderStatistics', [
            'monthlyStatistics' => $monthlyStatistics,
            'dailyStatistics' => $dailyStatistics,
            'year' => $year,
            'monthlyStatisticsJSON' => json_encode($monthlyStatistics),
            'dailyStatisticsJSON' => json_encode($dailyStatistics),
        ]);
    }
    public function dailyStatistics($year)
    {
        // Thống kê theo ngày
        $dailyStatistics = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as pending_orders'),
            DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as paid_orders')
        )
            ->whereYear('created_at', $year)
            ->whereNotIn('status', [3])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get();

        return $dailyStatistics;
    }

    public function storeAssess(Request $request)
    {
        $validated = $request->validate([
            'star' => 'required|numeric|min:1|max:5',
            'content' => 'required|string',
            'order_id' => 'required|exists:orders,id',
        ]);

        try {
            $assess = new Assess();
            $assess->star = $validated['star'];
            $assess->content = $validated['content'];
            $assess->order_id = $validated['order_id'];
            $assess->user_id = auth()->id();
            $assess->save();

            return response()->json([
                'success' => true,
                'message' => 'Đánh giá đã được lưu thành công!',
                'data' => $assess,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lưu đánh giá.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

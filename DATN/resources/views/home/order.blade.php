@extends("shared._layoutMain")
@section("title", "Main")
@section("content")
<main class="p-8 bg-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-center text-blue-500 text-xl font-bold mb-4">THÔNG TIN LIÊN HỆ</h2>
            <form class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox" />
                            <span>Xác nhận gửi cho số được gửi qua email này.</span>
                        </label>
                        <input type="email" placeholder="Email" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox" />
                            <span>Chúng tôi sẽ liên hệ với quý khách qua SĐT này.</span>
                        </label>
                        <input type="text" placeholder="Số điện thoại" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <input type="text" placeholder="Họ và tên" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <input type="text" placeholder="Địa chỉ" class="w-full p-2 border rounded" />
                    </div>
                </div>
                <textarea placeholder="Yêu cầu thêm" class="w-full p-2 border rounded h-24"></textarea>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox" />
                    <span>Đặt trước giữ chỗ, thanh toán sau. Dễ dàng, thuận tiện, nhanh chóng!</span>
                </div>
                <button type="submit" class="w-full bg-red-500 text-white p-2 rounded">HOÀN THÀNH</button>
            </form>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-center text-blue-500 text-xl font-bold mb-4">CHI PHÍ DỰ KIẾN</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Ngày khởi hành</label>
                        <input type="date" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <label>Số lượng</label>
                        <select class="w-full p-2 border rounded">
                            @foreach(range(1, 15) as $i)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Đơn giá</span>
                        
                        <span>1000000 đ</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tổng tiền</span>
                      
                        <span>2000000 đ</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Thanh toán</span>
                        
                        <span>300000 đ</span>
                    </div>
                </div>
                <div class="border-t pt-4">
                    <h3 class="font-bold">Tour Hàn Quốc: Hà Nội - Busan - Cố Đô Gyeongju - Seoul 6N5Đ</h3>
                    <div class="flex items-center space-x-4 mt-2">
                        <img src="https://placehold.co/100x100" alt="Tour Image" class="w-24 h-24 object-cover rounded" />
                        <div>
                            <p>6 ngày 5 đêm</p>
                            <p>Hạng tuần</p>
                            <p>Máy bay</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
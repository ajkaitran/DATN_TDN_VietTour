@extends("shared._layoutMain")
@section("title", "Main")
@section("content")
@if ($errors->any())
<div class="alert alert-danger my-3">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<main class="p-8 bg-gray-100">
    <form action="{{ route('home.storeOrder') }}" method="POST" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-center text-blue-500 text-xl font-bold mb-4">THÔNG TIN LIÊN HỆ</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox" />
                            <span>Xác nhận gửi cho số được gửi qua email này.</span>
                        </label>
                        <input type="email" name="customer_info_email" value="{{$user->email}}" id="customer_info_email" placeholder="Email" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox" />
                            <span>Chúng tôi sẽ liên hệ với quý khách qua SĐT này.</span>
                        </label>
                        <input type="text" name="customer_info_phone" value="{{$user->phone}}" id="customer_info_phone" placeholder="Số điện thoại" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <input type="text" name="customer_info_full_name" value="{{$user->name}}" id="customer_info_full_name" placeholder="Họ và tên" class="w-full p-2 border rounded" />
                    </div>
                    <div>
                        <input type="text" name="customer_info_address" id="customer_info_address" placeholder="Địa chỉ" class="w-full p-2 border rounded" />
                    </div>
                </div>
                <textarea placeholder="Yêu cầu thêm" class="w-full p-2 border rounded h-24"></textarea>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" class="form-checkbox" />
                    <span>Đặt trước giữ chỗ, thanh toán sau. Dễ dàng, thuận tiện, nhanh chóng!</span>
                </div>
                <button type="submit" class="w-full bg-red-500 text-white p-2 rounded">HOÀN THÀNH</button>
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
                            <select id="quantity" class="w-full p-2 border rounded">
                                @foreach(range(1, 15) as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Đơn giá</span>
                            <span id="unit-price" data-price="{{ $tour->sale_off }}">{{ number_format($tour->sale_off, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tổng tiền</span>
                            <span id="total-price">0 đ</span>
                        </div>
                        <input type="hidden" name="price" id="hidden-total-price" />
                        <input type="hidden" name="product_id" id="product_id" value="{{ $tour->id }}" />
                    </div>
                    <div class="border-t pt-4">
                        <h3 class="font-bold">{{$tour->name}}</h3>
                        <div class="flex items-center space-x-4 mt-2">
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="Tour Image" class="w-24 h-24 object-cover rounded" />
                            <div>
                                <p>{{$tour->schedule}}</p>
                                <p>{{$tour->transport}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
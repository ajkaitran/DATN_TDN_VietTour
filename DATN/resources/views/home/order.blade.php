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
<section class="m-5">
    <div class="container">

        <form method="POST" class="space-y-4" id="orderForm">
            @csrf
            <div class="row gap-4 flex-nowrap">
                <div class="col-7 bg-gray-100 p-3 ">
                    <h2 class="title_order mb-2">THÔNG TIN LIÊN HỆ</h2>
                    <div class="row">
                        <div class="col-6">
                            <label class="label_input">Email*</label>
                            <label class="flex items-center space-x-2">
                                <i class="fa fa-info-circle"></i>
                                <span style="font-size: 13px;">Xác nhận gửi cho số được gửi qua email này.</span>
                            </label>
                            <div class="input_item">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="customer_info_email" value="{{$user->email ?? ""}}" id="customer_info_email" placeholder="Email" required/>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="label_input">Số điện thoại*</label>
                            <label class="flex items-center space-x-2">
                                <i class="fa fa-info-circle"></i>
                                <span  style="font-size: 13px;">Chúng tôi sẽ liên hệ với quý khách qua SĐT này.</span>
                            </label>
                            <div class="input_item">
                                <i class="fa-solid fa-phone"></i>
                                <input type="text" name="customer_info_phone" value="{{$user->phone ?? ""}}" id="customer_info_phone" placeholder="Số điện thoại" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="label_input">Họ và tên*</label>
                            <div class="input_item">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="customer_info_full_name" value="{{$user->name ?? ""}}" id="customer_info_full_name" placeholder="Họ và tên" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="label_input">Địa chỉ</label>
                            <div class="input_item">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" name="customer_info_address" id="customer_info_address" placeholder="Địa chỉ"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="label_input">Yêu cầu thêm</label>
                        <textarea class="w-full p-2 border rounded h-24" name="customer_info_body"></textarea>
                    </div>
                    <div class="alert alert-primary title_order mt-2" style="font-size: 16px">
                        <i class="fa-solid fa-square-check"></i>
                        <span>Đặt trước giữ chỗ, thanh toán sau. Dễ dàng, thuận tiện, nhanh chóng!</span>
                    </div>
                    <button type="submit" class="w-full bg-red-500 text-white p-2 rounded">HOÀN THÀNH</button>
                </div>
                <div class="col-5 bg-gray-100 p-3">
                    <h2 class="title_order mb-2">CHI PHÍ DỰ KIẾN</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label_input">Ngày khởi hành*</label>
                                <div class="input_item">
                                    <i class="fa-solid fa-calendar-days" style="width: 15%;"></i>
                                    <input type="date"name="transport_date" placeholder="dd/mm/yyyy" required>
                                </div>
                            </div>
                            <div>
                                <label class="label_input">Số lượng</label>
                                <div class="input_item">
                                    <i class="fa-solid fa-hashtag" style="width: 15%;"></i>
                                    <select id="quantity"  name="quantity">
                                        @foreach(range(1, 10) as $i)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div>
                                <label class="label_input">Ngày về*</label>
                                <div class="input_item">
                                    <i class="fa-solid fa-calendar-days" style="width: 15%;"></i>
                                    <input type="date"name="return_date" placeholder="dd/mm/yyyy" required>
                                </div>
                            </div> --}}
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
                            <div class="flex space-x-4 mt-2">
                                <img src="{{ asset('storage/' . $tour->image) }}" alt="Tour Image" class="object-cover rounded" style="width: 150px; height: 150px;"/>
                                <div>
                                    <h3 class="font-bold mb-2">{{$tour->name}}</h3>
                                    <p><i class="fa-solid fa-business-time"></i> {{$tour->schedule}}</p>
                                    <p><i class="fa-solid fa-car"></i> {{$tour->transport}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
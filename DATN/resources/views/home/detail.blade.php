@extends("shared._layoutMain")
@section("title", "Main")
@section("content")
<div class="container mx-auto p-4 ">
    <nav class="text-sm text-gray-500 mb-4 ">
        <a href="/" class="hover:underline text-gray-500">Trang chủ</a> &gt;
        <span>{{$item->name}}</span>
    </nav>
    <h1 class="text-2xl font-bold text-blue-600 mb-2">{{$item->name}}</h1>
    <p class="text-sm text-gray-500 mb-2">
        <i class="fas fa-calendar-alt"></i> Lịch khởi hành: <span class="text-red-500">{{$item->schedule}}</span>
    </p>
    <div class="flex items-center mb-4">
        <div class="star">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <=$item->star)
                <i class="fa-solid fa-star"></i>
                @else
                <i class="fa-regular fa-star"></i>
                @endif
                @endfor
        </div>
        <button class="ml-auto bg-blue-500 text-white px-4 py-2 rounded flex items-center">
            <i class="fas fa-share mr-2"></i> Share
        </button>
    </div>
    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4"> -->
    <div class="md:col-span-2 relative">
        <!-- Ảnh tour -->
        <img
            src="{{ asset('storage/'.$item->image)}}"
            alt="image tour"
            class="w-full max-h-96 object-cover rounded-lg" />
        <p
            class="text-white text-sm absolute bottom-2 left-2 bg-black bg-opacity-70 px-2 py-1 rounded">
            {{ $item->name }}
        </p>
    </div>
    <!-- <div class="grid grid-cols-2 gap-4">
            <div class="relative">
                <img src="https://placehold.co/400x200" alt="A person looking at the mountains from a balcony at Combo Sapa Jade Hill Resort & Spa" class="w-full rounded-lg" />
                <p class="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
            </div>
            <div class="relative">
                <img src="https://placehold.co/400x200" alt="A person enjoying a waterfall in a pool at Combo Sapa Jade Hill Resort & Spa" class="w-full rounded-lg" />
                <p class="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
            </div>
            <div class="relative">
                <img src="https://placehold.co/400x200" alt="A person walking on a path surrounded by trees at Combo Sapa Jade Hill Resort & Spa" class="w-full rounded-lg" />
                <p class="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
            </div>
            <div class="relative">
                <img src="https://placehold.co/400x200" alt="A person sitting in front of a thatched-roof house at Combo Sapa Jade Hill Resort & Spa" class="w-full rounded-lg" />
                <p class="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
            </div>
        </div> -->
    <!-- </div> -->
</div>
<div class="container mx-auto p-4">
    <div class="flex flex-col lg:flex-row">
        <div class="lg:w-2/3 p-4">
            <p class="text-gray-700 mb-4">
                {{$item->description}} <span class="text-blue-600">Liên hệ ngay với chúng tôi {{$item->hotline}}</span> - Bạn chỉ việc đặt tour, việc còn lại để chúng tôi lo!
            </p>
            <div class="flex space-x-4 mb-4">
                <a href="">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded flex items-center">
                        <i class="fas fa-gift mr-2"></i> Giữ chỗ bây giờ - Thanh toán sau
                    </button>
                </a>
                <a href="">
                    <button class="bg-red-500 text-white py-2 px-4 rounded flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i> Bấm để nghe tư vấn miễn phí
                    </button>
                </a>

            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="bg-blue-500 text-white text-center py-2 rounded mb-4">{{$item->name}} CÓ GÌ ĐẶC SẮC</h2>
                <ul class="list-disc list-inside text-gray-700">
                    {!! $item->highlights !!}
                </ul>
            </div>

            <div class="mt-3 mb-3 bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center mb-6">
                    <button class="mt-3 bg-blue-500 text-white py-2 px-4 rounded-full text-lg font-semibold">
                        NÀO CÙNG XEM TRƯỚC LỘ TRÌNH
                    </button>
                </div>
                <div class="divide-y divide-gray-300">
                    @foreach ($item->itineraries as $itinerary)
                    <div class="group">
                        <button class="flex items-center justify-between w-full py-3 px-4 text-left hover:bg-blue-50">
                            <span class="font-semibold">{{$itinerary->title}}</span>
                            <span class="text-blue-500 group-hover:rotate-180 transform transition-transform duration-300">
                                &#x25BC;
                            </span>
                        </button>
                        <div class="hidden group-focus-within:block px-4 py-2 text-gray-600">
                            {!!$itinerary->description!!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center mb-6">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-full text-lg font-semibold">
                        CHÍNH SÁCH NHẬN & TRẢ PHÒNG
                    </button>
                </div>
                <div class="text-gray-800">
                    <h2 class="font-bold text-lg mb-2">Giờ nhận - trả phòng:</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li>Giờ nhận phòng: 14:00</li>
                        <li>Giờ trả phòng: 12:00</li>
                    </ul>
                    <h2 class="font-bold text-lg mb-2">Quy định nhận phòng: Khách đến nhận phòng vui lòng mang theo:</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li>Giấy xác nhận của Việt Tour</li>
                        <li>CCCD hoặc passport</li>
                    </ul>

                    <h2 class="font-bold text-lg mb-2">Lưu ý:</h2>
                    {!!$item->notes !!}
                </div>
            </div>
            <div class="mt-6">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h2 class="text-center text-blue-500 font-bold text-lg mb-4">Cảm ơn quý khách, chúc quý khách có một chuyến đi vui vẻ</h2>
                    <p class="text-center text-gray-800"> Việt Tour - Đơn vị tổ chức tour du lịch hàng đầu!</p>
                </div>
            </div>
            <div class="flex flex-col w-full  p-4 mt-4 md:mt-0">
                <button class="bg-gradient-to-r from-blue-500 to-blue-300 text-white py-2 px-4 rounded mb-4">
                    ĐÁNH GIÁ CỦA KHÁCH HÀNG
                </button>
                <button class="bg-orange-500 text-white py-2 px-4 rounded self-end">
                    Viết đánh giá
                </button>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Viết đánh giá của bạn ở đây</h2>
                        <button class="text-gray-500"><i class="fas fa-times"></i></button>
                    </div>
                    <textarea
                        class="w-full p-2 border rounded-md mb-4"
                        placeholder="Feedback"
                        value=comment
                        id=edited></textarea>
                    <div class="flex space-x-4 mb-4">
                        <input
                            type="text"
                            placeholder="Full Name"
                            class="w-1/2 p-2 border rounded-md"
                            value=fullName />
                        <input
                            type="text"
                            placeholder="Address"
                            class="w-1/2 p-2 border rounded-md"
                            value=address />
                    </div>
                    <input
                        type="file"
                        class="bg-green-500 text-white p-2 rounded-md mb-4" />
                    <p class="text-gray-500 text-sm mb-4">- Choose an image: gif, png, jpg, jpeg less than 2MB</p>
                    <button class="bg-blue-500 text-white p-2 rounded-md">Submit Feedback</button>
                </div>
            </div>
            <div class="flex flex-col w-full  p-4 mt-4 md:mt-0">
                <button class="bg-gradient-to-r from-blue-500 to-blue-300 text-white py-2 px-4 rounded mb-4">
                    CÂU HỎI THƯỜNG GẶP
                </button>
                <button class="bg-orange-500 text-white py-2 px-4 rounded self-end">
                    Viết câu hỏi
                </button>
            </div>
        </div>

        <div class="lg:w-1/3 p-4">
            <div class="bg-white p-4 rounded shadow mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="line-through text-gray-500">{{ number_format($item->sale_off, 0, ',', '.') }}đ</span>
                    <!-- <span class="bg-red-500 text-white px-2 py-1 rounded">Tiết kiệm 44%</span> -->
                </div>
                <div class="text-red-500 text-2xl font-bold mb-2">Giá mới: {{ number_format($item->price, 0, ',', '.') }}đ</div>
                <div class="star">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=$item->star)
                        <i class="fa-solid fa-star"></i>
                        @else
                        <i class="fa-regular fa-star"></i>
                        @endif
                        @endfor
                </div>
                <div class="text-gray-700 mb-2">Lịch khởi hành: Hàng ngày</div>
                <div class="text-gray-700 mb-4">Phương tiện: {{$item->transport}}</div>
                <button class="bg-blue-500 text-white py-2 px-4 rounded w-full mb-4">
                    <a href="{{route('home.order',['id' => $item->id])}}">Đặt Ngay</a>
                </button>
                <div class="text-center text-gray-700 mb-4">Giữ chỗ ngay bây giờ - Tính tiền sau</div>
                <!-- <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-phone-alt text-orange-500 mr-2"></i>
                    <span class="text-orange-500">Hotline tư vấn 24/7</span>
                </div>
                <div class="text-center text-orange-500 text-2xl mb-4">1900 4692</div>
                <div class="text-center text-gray-700 mb-4">Để lại SĐT chúng tôi sẽ gọi cho bạn</div> -->
                <!-- <div class="flex items-center border border-gray-300 rounded p-2">
                    <input type="text" class="flex-grow outline-none" placeholder="Nhập số điện thoại của bạn..." />
                    <button class="text-blue-500"><i class="fas fa-paper-plane"></i></button>
                </div> -->
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-700 mb-4">Tour Khuyến mãi</h3>
                @foreach ($otherTours as $otherItem)
                <div class="mb-4">
                    <a href="{{route('home.detail',['id' => $otherItem->id])}}">
                        <img src="{{ asset('storage/'.$otherItem->image)}}" alt="TourImage" class="w-full h-60 object-cover rounded mb-2" />
                        <div class="tour_name title_name">{{$otherItem->name}}</div>
                    </a>
                    <div class="text-gray-500">Lịch khởi hành:{{ number_format($otherItem->sale_off, 0, ',', '.') }}đ
                    </div>
                    <div class="text-red-500 font-bold"> <span class="line-through text-gray-500">{{ number_format($otherItem->price, 0, ',', '.') }}đ</span></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
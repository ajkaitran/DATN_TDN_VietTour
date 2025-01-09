@extends("shared._layoutMain")
@section("title", "Main")
@section("content")

<div class="body">
    <main>
        <div class="relative">
            <img src="{{ asset('storage/' . $category->image) }}" alt="Image category" class="w-full" />
        </div>
        <div class="container mx-auto flex py-10 px-6">
            <aside class="w-1/4 bg-gray-100 p-4 rounded">
                <h2 class="text-xl font-bold mb-4">Lọc kết quả</h2>
                <form action="{{ route('home.tourLog', $category->id) }}" method="GET">
                    <!-- Từ khóa tìm kiếm -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Tìm kiếm</h3>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Nhập từ khóa tìm kiếm..." class="w-full px-4 py-2 rounded" />
                    </div>

                    <!-- Lọc theo loại tour -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Loại Tour</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="type[]" value="1" {{ in_array(1, (array)request('type')) ? 'checked' : '' }} class="mr-2" />
                                Tour nội địa
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="type[]" value="2" {{ in_array(2, (array)request('type')) ? 'checked' : '' }} class="mr-2" />
                                Tour quốc tế
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="type[]" value="3" {{ in_array(3, (array)request('type')) ? 'checked' : '' }} class="mr-2" />
                                Combo du lịch
                            </label>
                        </div>
                    </div>

                    <!-- Điểm đi -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Điểm Đi</h3>
                        <select name="from" class="w-full px-4 py-2 rounded">
                            <option value="">--Chọn địa điểm--</option>
                            @foreach($starts as $start)
                            <option value="{{ $start->id }}" {{ request('from') == $start->id ? 'selected' : '' }}>
                                {{ $start->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Nút lọc -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lọc</button>
                </form>
            </aside>
            <section class="w-3/4 pl-6">
                <h1 class="text-3xl font-bold text-blue-600 mb-6">{{$category->name}}</h1>
                <div class="bg-blue-100 p-6 rounded">
                    <h2 class="text-2xl font-bold mb-4">Lý Do Chọn Tour Việt Tour Travel</h2>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="text-center">
                            <i class="fas fa-star text-yellow-500 text-4xl mb-2"></i>
                            <p>Nhiều năm kinh nghiệm phục vụ hàng ngàn lượt khách mỗi năm</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-clock text-red-500 text-4xl mb-2"></i>
                            <p>Khởi hành liên tục hàng tuần, lễ tết, dịp đặc biệt</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-dollar-sign text-green-500 text-4xl mb-2"></i>
                            <p>Mức giá tốt nhất Giá cả phù hợp & nhiều ưu đãi hấp dẫn</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-thumbs-up text-blue-500 text-4xl mb-2"></i>
                            <p>Hỗ trợ 11/24 giờ cao Hỗ trợ & chăm sóc khách hàng 24/7, tỉ lệ hài lòng 99%</p>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-3">
                    @foreach($tours as $items)
                    <div class="col my-3">
                        <div class="tour_card">
                            <a class="tour_img" href="{{route('home.detail',['id' => $items->id])}}">
                                <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
                            </a>
                            <div class="tour_content">
                                <a class="tour_name title_name" href="{{route('home.detail',$items->id)}}">{{$items->name}}</a>
                                <div class="star">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <=$items->star)
                                        <i class="fa-solid fa-star"></i>
                                        @else
                                        <i class="fa-regular fa-star"></i>
                                        @endif
                                        @endfor
                                </div>
                                <div class="date-go">
                                    <i class="fa-solid fa-calendar-clock me-1"></i>Lịch khởi hành: <time>{{$items->transport}}</time>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-7">
                                        <div class="price_box">
                                            <span>{{ number_format($items->sale_off, 0, ',', '.') }}đ</span>
                                            <del>{{ number_format($items->price, 0, ',', '.') }}đ</del>
                                        </div>
                                    </div>
                                    <div class="col-5 d-flex justify-content-end align-items-center">
                                        <a class="btn_card" href="{{ route('home.order', ['id' => $items->id]) }}">
                                            <i class="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

</div>
@endsection
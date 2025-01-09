@extends("shared._layoutMain")
@section("title", "Main")
@section("content")

<div class="body">
    <main>
        <div class="relative">
            <img src="{{ asset('storage/categoryTour/' . $category_type->image) }}" alt="Image category" class="w-full max-h-96 object-cover" />
        </div>
        <div class="container mx-auto flex py-10 px-6">
            <div class="col-3 bg-gray-100 rounded">
                <h1 class="title_list title">
                    {{$category_type->name}}
                </h1>
                <div class="p-4">
                    <form action="{{ route('home.tourLog', $category_type->id) }}" method="GET">
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
                        <button type="submit" class="btn_card">Lọc Dữ Liệu</button>
                    </form>
                </div>
            </div>
            <section class="col-9 pl-6">
                <div class="box-banners">
                    <h1 class="title_bold mb-3">Lý Do Chọn Tour VietTour Travel</h1>
                    <div class="row row-cols-4">
                        @foreach ($listBanner6 as $items)
                        <div class="col">
                            <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh">
                            <h4><strong>{{$items->banner_name}}</strong></h4>
                            <p>{{$items->slogan}}</p>
                        </div>
                        @endforeach
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
                <div class="d-flex justify-center">
                    {{$tours->links()}}
                </div>
            </section>
        </div>
    </main>

</div>
@endsection
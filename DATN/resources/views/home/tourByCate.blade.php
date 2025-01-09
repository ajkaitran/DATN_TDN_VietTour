@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<div class="relative">
    <img src="{{ $category->image?''.Storage::url($category->image):''}}">
</div>
<div class="tour-by-cate">
    <section class="index_3 bg-white p-5 rounded-lg shadow-md">
        <div class="container">
            <h2 class="title_index title">{{ $category->name }}</h2>
            <div class="row row-cols-4">
                @foreach($tours as $item)
                <div class="col my-3">
                    <div class="tour_card">
                        <a class="tour_img" href="{{route('home.detail',['id' => $item->id])}}">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="hình ảnh" width="100">
                        </a>
                        <div class="tour_content">
                            <a class="tour_name title_name" href="{{route('home.detail',$item->id)}}">{{$item->name}}</a>
                            <div class="star">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <=$item->star)
                                    <i class="fa-solid fa-star"></i>
                                    @else
                                    <i class="fa-regular fa-star"></i>
                                    @endif
                                    @endfor
                            </div>
                            <div class="date-go">
                                <i class="fa-solid fa-calendar-clock me-1"></i>Lịch khởi hành: <time>{{$item->transport}}</time>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7">
                                    <div class="price_box">
                                        <span>{{ number_format($item->sale_off, 0, ',', '.') }}đ</span>
                                        <del>{{ number_format($item->price, 0, ',', '.') }}đ</del>
                                    </div>
                                </div>
                                <div class="col-5 d-flex justify-content-end align-items-center">
                                    <a class="btn_card" href="#">
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
        </div>
    </section>
</div>

@endsection
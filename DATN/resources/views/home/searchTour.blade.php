@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<div class="relative">
    <img src="{{ url('images/cover-tim-kiem-533.jpg') }}">
</div>
<div class="search-tour">
    @if ($items->isEmpty())
    <h2 class="title_index title">Không tìm thấy tour nào phù hợp với từ khóa "{{ request('keyword') }}".</h2>
    @else
    <section class="index_3 bg-white p-5 rounded-lg shadow-md">
        <div class="container">
            <h2 class="title_index title">Kết quả tìm kiếm</h2>
            <div class="row row-cols-4">
                @foreach($items as $item)
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
                                    @auth
                                        @if(in_array(auth()->user()->role, [2, 3]))
                                            <a class="btn_card" href="{{ route('home.order', ['id' => $item->id]) }}">
                                                <i class="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                            </a>
                                        @else
                                            <a class="btn_card" href="#" data-bs-toggle="modal" data-bs-target="#ModalLogin">
                                                <i class="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                            </a>
                                        @endif
                                    @else
                                        <a class="btn_card" href="#" data-bs-toggle="modal" data-bs-target="#ModalLogin">
                                            <i class="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                {{$items->links()}}
            </div>
        </div>
    </section>
    @endif
</div>

@endsection
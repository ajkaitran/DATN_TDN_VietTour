@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<style>
    #comments-section {
        max-height: 100px;
        overflow-y: auto;
    }
</style>
<div class="relative mb-5">
    <img src="{{ url('images/blog.jpg') }}">
</div>
<div class="container">
    <div class="mx-auto px-4 py-8 max-w-screen-lg">
        <h3>Danh mục : {{ $article->articleCategory->category_name }}</h3>
        <br>
        <!-- Blog Header -->
        <div class="text-center">
            <h3 class="text-2xl font-bold text-blue-600 mb-4">
                {{ $article->subject }}
            </h3>
            <p class="text-gray-700 text-lg bg-blue-50 p-4 rounded-md border-l-4 border-blue-500">
                {{ $article->description }}
            </p>
        </div>

        <div class="mt-6 justify-center">
            <img
                src="{{ Storage::url('article/' . $article->image) }}"
                alt="Hình ảnh minh họa"
                class="rounded-lg shadow-md block mx-auto w-8/12 md:max-w-md lg:max-w-lg">
            <p class="text-sm text-gray-500 mt-2 text-center w-full">Hình ảnh minh họa</p>
        </div>

        <!-- Blog Content -->
        <div class="mt-8">
            {!! $article->body !!}
        </div>

        <div class="flex flex-col w-full p-4 mt-4 md:mt-0">
            <h2 class="text-xl font-bold mb-4">Đánh giá của khách hàng</h2>
            <div id="comments-section" class="mb-6" style="max-height: 400px; overflow-y: auto;">
                @foreach($comments as $comment)
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <div class="flex items-center mb-2">
                    @if (!empty($comment->loadAllUser->image))
                        <img src="{{ Storage::url($comment->loadAllUser->image) }}" alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                        @else
                        <img src="{{ asset('images/avatar-mac-dinh.jpg') }}" alt="ảnh mặc định" class="w-10 h-10 rounded-full mr-3">
                        @endif
                        <div>
                            <p class="font-semibold">{{ $comment->loadAllUser->username }}</p>
                            <p class="text-gray-500 text-sm">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <p>{{ $comment->content }}</p>
                </div>
                @endforeach
            </div>


            @auth
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Viết bình luận của bạn</h2>
                <form action="{{ route('home.comment', ['id' => $article->id]) }}" method="POST">
                    @csrf
                    <textarea
                        name="content"
                        class="w-full p-2 border rounded-md mb-4"
                        placeholder="Viết bình luận của bạn ở đây"
                        required></textarea>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Gửi bình luận</button>
                </form>

            </div>
            @else
            <p class="text-red-500">Bạn cần <a href="#"data-bs-toggle="modal" data-bs-target="#ModalLogin" class="text-blue-500 underline">đăng nhập</a> để viết bình luận.</p>
            @endauth
        </div>

    </div>
</div>


@endsection
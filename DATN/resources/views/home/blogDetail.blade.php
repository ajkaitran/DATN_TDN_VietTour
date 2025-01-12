@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
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
    </div>
</div>


@endsection
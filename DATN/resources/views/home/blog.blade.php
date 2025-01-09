@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<div class="relative mb-5">
    <img src="{{ url('images/blog.jpg') }}">
</div>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-600 mb-4">
            <a class="text-blue-500" href="#">
                <i class="fas fa-home">
                </i>
                Trang chủ
            </a>>
            Blog du lịch
        </div>
        <!-- Main Content -->
        <h1 class="text-center text-blue-600 text-2xl font-bold mb-4">
            BLOG DU LỊCH
        </h1>
        <div class="flex flex-col lg:flex-row ">
            <!-- Search Sidebar -->
            <div class="w-full lg:w-1/4 mb-4 lg:mb-0 mr-3">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-blue-600 text-lg font-bold mb-4">
                        TÌM KIẾM
                    </h2>
                    <input class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Nhập từ khóa tìm kiếm..." type="text" />
                    <ul class="space-y-2">
                        <li>
                            <a class=" text-blue-500" href="#">
                                Blog du lịch
                            </a>
                        </li>
                        <li>
                            <a class="text-blue-500" href="#">
                                Review
                            </a>
                        </li>
                        <li>
                            <a class="text-blue-500" href="#">
                                Điểm đến
                            </a>
                        </li>
                        <li>
                            <a class="text-blue-500" href="#">
                                Ẩm thực
                            </a>
                        </li>
                        <li>
                            <a class="text-blue-500" href="#">
                                Kinh nghiệm
                            </a>
                        </li>
                    </ul>
                    <button class="w-full bg-blue-500 text-white py-2 rounded mt-4">
                        Tìm kiếm
                    </button>
                </div>
            </div>
            <!-- Blog Content -->
            <div class="w-full lg:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($listArticles as $items)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="A beautiful traditional Chinese building by a lake" class="w-full h-48 object-cover" height="400" src="{{ Storage::url('article/' . $items->image) }}" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                {{$items->articleCategory->category_name}}
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2 article_title">
                                {{$items->subject}}
                            </h3>
                            <p class="text-gray-600 text-sm article_content">
                                {{$items->description}}
                            </p>
                        </div>
                    </div>
                    
                    @endforeach
                </div>
                <div class="my-3">
                    {{$listArticles->links()}}  
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
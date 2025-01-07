@extends("shared._layoutMain")
@section("title", "Main")

@section("content")

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
            <div class="w-full lg:w-1/4 mb-4 lg:mb-0 mr-3" >
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
                    <!-- Blog Post 1 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="A beautiful traditional Chinese building by a lake" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/kA4wnrOJxM6RDtMyFiMsWZTG8W1ENz76doJbfdTNTCBoQZBKA.jpg" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                Điểm đến
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2">
                                Ngỡ ngàng trước vẻ đẹp tựa thiên đường của Cổ trấn Lệ Giang
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Nhắc đến những cảnh đẹp "cảnh sắc vẹn toàn" của Trung Quốc, không thể nào không nhắc đến Cổ Trấn Lệ Giang – nơi...
                            </p>
                        </div>
                    </div>
                    <!-- Blog Post 2 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="A person in traditional Chinese attire" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/2fAF9MvxSyzseUi5yhJfUAQBrNyIQo12hU9FidpNcIrlClFoA.jpg" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                Review
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2">
                                "Để mị nói cho mà nghe" top 9 điểm đến nhất định không thể bỏ qua khi...
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Nhắc đến Trung Quốc, người ta thường nghĩ ngay đến một đất nước rộng lớn với vô vàn điểm đến tham quan tuyệt đẹp...
                            </p>
                        </div>
                    </div>
                    <!-- Blog Post 3 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="A traditional Japanese building with a person in traditional attire" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/UgtGtNm8UeXekUxhGaBsdXhNfFlGXgKI6LeFbfjS6vo7JUWgC.jpg" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                Điểm đến
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2">
                                Xiêu lòng trước khung cảnh cổ đô Kyoto. Kinh nghiệm du lịch Kyoto từ...
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Kyoto với vẻ đẹp cổ kính và văn hóa truyền thống ngàn đời là điểm đến lý tưởng cho những ai yêu thích khám phá...
                            </p>
                        </div>
                    </div>
                    <!-- Blog Post 4 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="A traditional Japanese temple with people in traditional attire" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/7QMtG6ZBTIbXIxOyGkPNZm0Y37zrJfkpsci4pOychweNhyCUA.jpg" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                Điểm đến
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2">
                                Đến thờ Asakusa Kannon – Điểm đến linh thiêng hàng đầu Nhật Bản
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Đền Asakusa Kannon hay Sensoji, là một trong những biểu tượng văn hóa lâu đời và nổi tiếng nhất của Tokyo. Với kiến trúc...
                            </p>
                        </div>
                    </div>
                    <!-- Blog Post 5 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="People enjoying Japanese food" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/nD65piKtIYbDMZYjV9ELIC6VUWCV6pqLuXWfjJ2yEIulQZBKA.jpg" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                Kinh nghiệm
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2">
                                Du lịch Nhật Bản mùa gì sẽ làm bạn mê mẩn? Ghi điểm với list những món...
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Khi bạn đang băn khoăn không biết du lịch Nhật Bản mùa nào là đẹp nhất. Vốn là một đất nước có bốn mùa rõ ràng...
                            </p>
                        </div>
                    </div>
                    <!-- Blog Post 6 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img alt="A couple enjoying the autumn scenery with Mount Fuji in the background" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/iHgv4e7iV8RbHqJ1IeoLei9lCiZCMdAhlaQza4ukAXVoClFoA.jpg" width="600" />
                        <div class="p-4">
                            <h2 class="text-blue-500 text-sm font-semibold mb-2">
                                Review
                            </h2>
                            <h3 class="text-gray-800 font-bold mb-2">
                                Đắm chìm trước khung cảnh lãng mạn khi du lịch Nhật Bản mùa lá đỏ
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Thu về, những tán lá phong bắt đầu thay màu đỏ mới cũng là lúc Nhật Bản bước vào mùa du lịch đẹp nhất trong năm –...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
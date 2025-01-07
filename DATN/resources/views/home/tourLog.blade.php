@extends("shared._layoutMain")
@section("title", "Main")
@section("content")

<div class="body">
    <main>
        <div class="relative">
            <img src={Banner2} alt="Phú Quốc" class="w-full" />
        </div>
        <div class="container mx-auto flex py-10 px-6">
            <aside class="w-1/4 bg-gray-100 p-4 rounded">
                <h2 class="text-xl font-bold mb-4">Lọc kết quả</h2>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Phú Quốc</h3>
                    <input type="text" placeholder="Nhập từ khóa tìm kiếm..." class="w-full px-4 py-2 rounded" />
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Loại Tour</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2" /> Tour nội địa
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2" /> Tour quốc tế
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2" /> Tour Tâm linh
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2" /> Combo du lịch
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Điểm Đi</h3>
                    <select class="w-full px-4 py-2 rounded">
                        <option>--Chọn địa điểm--</option>
                    </select>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Điểm Đến</h3>
                    <select class="w-full px-4 py-2 rounded">
                        <option>Chọn địa điểm</option>
                    </select>
                </div>
            </aside>
            <section class="w-3/4 pl-6">
                <h1 class="text-3xl font-bold text-blue-600 mb-6">PHÚ QUỐC</h1>
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
                <div class="mt-6 bg-green-100 p-4 rounded text-center text-green-700">
                    Danh mục chưa có nội dung vui lòng quay lại sau!
                </div>
            </section>
        </div>
    </main>
    
</div>
@endsection
@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<main class="container mx-auto my-8 px-6">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">
            VỀ CHÚNG TÔI
        </h1>
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2">
                1. Chúng tôi là ViệtTour Travel
            </h2>
            <p class="mb-4">
                Ra đời từ năm 10/10/2017, ViệtTour Travel là đơn vị tổ chức chuyên nghiệp các chương trình tour du lịch trong nước và quốc tế. Với tiêu chí là hiện thực hóa những ước mơ trải nghiệm, chúng tôi luôn nỗ lực mang đến những dịch vụ tốt nhất cho khách hàng.
            </p>
            <img alt="Team of Nam A Travel" class="w-full mb-4" height="400" src="https://storage.googleapis.com/a1aa/image/Gop5lsdGHQZWPNkto9yQwYWTQ6q6Bo1zlPmNSmoCUHXSdsAF.jpg" width="800" />
            <p class="italic text-center mb-4">
                Đội ngũ nhân sự chuyên nghiệp, dày dặn kinh nghiệm của ViệtTour Travel
            </p>
            <p class="mb-4">
                Với sứ mệnh phục vụ khách hàng và mang đến những trải nghiệm du lịch tuyệt vời, chúng tôi luôn nỗ lực không ngừng để hoàn thiện và phát triển. Nam A Travel không chỉ là một công ty du lịch, mà còn là người bạn đồng hành đáng tin cậy của mọi khách hàng.
            </p>
        </div>
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2">
                2. Dịch vụ cung cấp
            </h2>
            <p class="mb-4">
                ViệtTour Travel cung cấp đa dạng các dịch vụ du lịch, từ tour du lịch trong nước, tour du lịch quốc tế, đến các dịch vụ combo du lịch, thuê xe du lịch, và nhiều dịch vụ khác.
            </p>
            <img alt="Team working " class="w-full mb-4" height="400" src="https://storage.googleapis.com/a1aa/image/0VZjMtomp8ZnKx8SAsxtNiQQxPkp9HZC11M6fFMf3wIL1xCUA.jpg" width="800" />
            <p class="italic text-center mb-4">
                Cùng đội ngũ nhân viên hỗ trợ chuyên nghiệp
            </p>
            <p class="mb-4">
                Chúng tôi luôn đặt khách hàng lên hàng đầu và cam kết mang đến những dịch vụ tốt nhất. ViệtTour Travel sẽ là người bạn đồng hành đáng tin cậy của mọi khách hàng.
            </p>
        </div>
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2">
                3. Liên hệ với chúng tôi
            </h2>
            <div class="flex items-center mb-4">
                <img alt="Nam A Travel logo" class="h-10 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/TOxasZPtfeve2I5H48ZhSDBNmx3a82god0Ckju8SefPppOWgC.jpg" width="150" />
                <div>
                    <p class="font-bold">
                        CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ DỊCH VỤ DU LỊCH ViệtTour Travel
                    </p>
                    <p>
                        Mã số thuế: 0108029545
                    </p>
                    <p>
                        Giấy phép kinh doanh: 0108029545, cấp ngày 25/10/2017
                    </p>
                    <p>
                        Địa chỉ: Tầng 12, Tòa nhà 72 Trần Đăng Ninh, Cầu Giấy, Hà Nội
                    </p>
                    <p>
                        Hotline: 1900 4692
                    </p>
                    <p>
                        Email: marketing@nama.com
                    </p>
                    <p>
                        Website:
                        <a class="text-blue-700 hover:underline" href="#">
                        </a>
                    </p>
                </div>
            </div>
            <div class="flex space-x-4 mb-4">
                <a class="text-blue-700 hover:underline" href="#">
                    <i class="fab fa-facebook-f">
                    </i>
                    Facebook
                </a>
                <a class="text-blue-700 hover:underline" href="#">
                    <i class="fab fa-twitter">
                    </i>
                    Twitter
                </a>
                <a class="text-blue-700 hover:underline" href="#">
                    <i class="fab fa-instagram">
                    </i>
                    Instagram
                </a>
            </div>
            <div class="mb-4">
                <label class="block mb-2" for="comment">
                    Bình luận
                </label>
                <textarea class="w-full p-2 border rounded" id="comment" rows="4"></textarea>
            </div>
            <button class="bg-blue-700 text-white px-4 py-2 rounded">
                Gửi bình luận
            </button>
        </div>
    </div>
</main>
@endsection
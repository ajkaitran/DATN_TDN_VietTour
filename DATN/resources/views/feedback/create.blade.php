@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Thêm mới phản hồi
</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="box_content">
    <form action="{{ route ('feedback.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type">Loại Phản Hồi</label>
            <select class="form-control" id="type" name="type" required>
                <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Khách hàng nói về chúng tôi</option>
                <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Khách hàng tiêu biểu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="home_name">Họ tên</label>
            <input type="text" name="full_name" id="" class="form-control">
            @error('full_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="home_name">Dịa chỉ</label>
            <input type="text" name="address" id="" class="form-control">
            @error('address')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="home_name">Chức vụ</label>
            <input type="text" name="position" id="" class="form-control">
            @error('position')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-4 control-label">Ảnh</label>
            <div class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-xs-6">
                        <img id="image_preview"
                            src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                            alt="your image" style="max-width: 200px; height:100px; margin-bottom: 10px;"
                            class="img-fluid" />
                        <input type="file" name="image" accept="image/*"
                            class="form-control-file @error('image') is-invalid @enderror" id="img_truoc">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="comment">Lời Nhận Xét</label>
            <textarea class="form-control" id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
            @error('comment')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="order">Thứ Tự</label>
            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
            @error('order')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="active">Hoạt động</label>
            <input type="hidden" name="active" value="0"> <!-- Giá trị mặc định -->
            <input type="checkbox" name="active" id="active" value="1" {{ old('active', 1) ? 'checked' : '' }}> <!-- Giá trị mặc định là checked -->
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>

</div>
@endsection

@section('script')
<script>
    $(function() {
        function readURL(input, selector) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $(selector).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img_truoc").change(function() {
            readURL(this, '#image_preview');
        });

    });
</script>
@endsection
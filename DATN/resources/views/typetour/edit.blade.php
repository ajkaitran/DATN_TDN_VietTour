@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Thêm mới danh mục
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
    <form action="{{ route ('typetour.edit', ['id'=>$tourtype->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên loại tour</label>
            <input type="text" name="name" value="{{ $tourtype->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="home_name">Tên hiển thị trên Home</label>
            <input type="text" name="home_name" value="{{ $tourtype->home_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-4 control-label">Ảnh</label>
            <div class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-xs-6">
                        <img id="image_preview"
                            src="{{ $tourtype->image?''. Storage::url($tourtype->image):'' }}"
                            alt="your image" style="max-width: 200px; height:100px; margin-bottom: 10px;"
                            class="img-fluid" />
                        <input type="file" name="image" accept="image/*"
                            class="form-control-file @error('image') is-invalid @enderror" id="img_truoc">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="order">Thứ tự hiển thị</label>
            <input type="number" name="order"  class="form-control" value="{{ $tourtype->order }}">
        </div>
        <div class="form-group">
            <label for="show_menu">Hiển thị trên Menu</label>
            <input type="checkbox" name="show_menu" id="show_menu" value="1" 
            {{ old('show_menu', $tourtype->show_menu ?? 0) == 1 ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="show_home">Hiển thị trên Home</label>
            <input type="checkbox" name="show_home" id="show_home" value="1" 
            {{ old('show_home', $tourtype->show_home ?? 0) == 1 ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="active">Hoạt động</label>
            <input type="checkbox" name="active" id="show_active" value="1" checked
            {{ old('show_active', $tourtype->active ?? 0) == 1 ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="slug">Đường dẫn</label>
            <input type="text" name="slug" value="{{ $tourtype->slug }}" class="form-control">
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
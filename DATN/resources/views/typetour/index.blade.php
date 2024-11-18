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
<div class="right-column">
    <div class="formcontent">
        <div class="content p-3">
            <table class="table table-strped mt-4">
                <thead class="thead">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tên danh mục </th>
                        <th scope="col">Loại danh mục</th>
                        <th scope="col">Hiện Menu</th>
                        <th scope="col">Hiện trang chủ</th>
                        <th scope="col">Hoạt động</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tourtypes as $key => $tourtype)
                    <tr>
                        <td>{{ $tourtype->id }}</td>
                        <td><img src="{{ $tourtype->image?''.Storage::url($tourtype->image):''}}" style="width: 100px" /></td>
                        <td>{{ $tourtype->name }}</td>
                        <td>{{ $tourtype->home_name }}</td>
                        <td>
                            <input type="checkbox" name="show_menu" id="show_menu" value="1"
                                {{ old('show_menu', $tourtype->show_menu ?? 0) == 1 ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="active" id="active" value="1"
                                {{ old('active', $tourtype->active ?? 0) == 1 ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="show_home" id="show_home" value="1"
                                {{ old('show_home', $tourtype->show_home ?? 0) == 1 ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route ('typetour.edit', ['id'=>$tourtype->id]) }}">Sửa</a>
                            <a class="btn btn-danger" href="{{ route ('typetour.delete', ['id'=>$tourtype->id]) }}">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
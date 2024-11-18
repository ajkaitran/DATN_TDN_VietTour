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
                        <th scope="col">Tên </th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Loại phản hồi</th>
                        <th scope="col">Hoạt động</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listfeedback as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td><img src="{{ $feedback->image?''.Storage::url($feedback->image):''}}" style="width: 100px" /></td>
                        <td>{{ $feedback->full_name }}</td>
                        <td>{{ $feedback->comment }}</td>
                        <td>{{ $feedback->type == 0 ? 'Khách hàng nói về chúng tôi' : 'Khách hàng tiêu biểu' }}</td>
                        <td>
                            <input type="checkbox" name="active" id="active" value="1"
                                {{ old('active', $feedback->active ?? 0) == 1 ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route('feedback.edit', ['id'=>$feedback->id]) }}">Sửa</a>
                            <a class="btn btn-danger" href="{{ route('feedback.delete', ['id'=>$feedback->id]) }}">Xoá</a>
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
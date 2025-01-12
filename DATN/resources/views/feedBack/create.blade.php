@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Thêm Phản Hồi
    </h2>
    @if ($errors->any())
        <div class="alert alert-danger my-3">
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
        <a class="box_link" href="{{ route('feedback.index') }}">Danh sách phản hồi</a>
        <form action="{{ route('feedback.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mx-3">
                <div class="col-8 mx-auto">
                    <div class="form-group">
                        <label class="form_ext w-25" for="type">Loại Phản Hồi</label>
                        <select class="form-control w-75" id="type" name="type" required>
                            <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Khách hàng nói về chúng tôi
                            </option>
                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Khách hàng tiêu biểu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Địa Điểm</label>
                        <input type="text" class="form-control w-75" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Họ tên</label>
                        <input type="text" class="form-control w-75" name="full_name" value="{{ old('full_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Chức vụ</label>
                        <input type="text" class="form-control w-75" name="position" value="{{ old('position') }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" id="upload-container">Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*" name="image"
                                    multiple value="{{ old('image') }}" />
                            </label>
                            <div class="form__files-container" id="files-list-container"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Lời nhận xét</label>
                        <textarea type="text" class="form-control w-75" id="editor2" name="comment">
                    {{ old('comment') }}
                    </textarea>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="order">Thứ Tự</label>
                        <input type="number" class="form-control w-75" name="order" value="">
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Hoạt động</label>
                        <input type="checkbox" id="active" name="active" value="1"
                            {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

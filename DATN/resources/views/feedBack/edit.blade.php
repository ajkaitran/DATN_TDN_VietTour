@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Sửa phản hồi
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
        <a class="box_link" href="{{ route('feedback.index') }}">Danh sách</a>
        <form action="{{ route('feedback.update', ['id' => $feedback->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mx-3">
                <div class="col-8">
                    <div class="form-group">
                        <label for="type">Loại Phản Hồi</label>
                        <select class="form-control w-75" id="type" name="type" required>
                            <option value="0" {{ old('type', $feedback->type) == '0' ? 'selected' : '' }}>Khách hàng
                                nói về chúng tôi</option>
                            <option value="1" {{ old('type', $feedback->type) == '1' ? 'selected' : '' }}>Khách hàng
                                tiêu biểu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Họ tên</label>
                        <input type="text" class="form-control w-75" name="full_name" value="{{ $feedback->full_name }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Địa chỉ</label>
                        <input type="text" class="form-control w-75" name="address" value="{{ $feedback->address }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Chức vụ</label>
                        <input type="text" class="form-control w-75" name="position" value="{{ $feedback->position }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" id="upload-container">
                                Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*"
                                    name="image" />
                            </label>

                            <img id="preview-image" src="{{ Storage::url('feedback/' . $feedback->image) }}"
                                class="object-fit-cover" style="display: {{ $feedback->image ? 'block' : 'none' }}">
                            <div class="form__files-container" id="files-list-container"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <td>{{ $feedback->order }}</td>
                        <label for="" class="form_ext w-25">Lời nhận xét</label>
                        <textarea type="text" class="form-control w-75" id="editor2" value="" name="comment">
                    {{ old('comment', $feedback->comment) }}
                    </textarea>
                    </div>
                    <div class="form-group">
                        <label for="order">Thứ Tự</label>
                        <input type="number" class="form-control w-75" name="order" value="{{ $feedback->order }}">
                        @error('order')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Hoạt động</label>
                        <input type="checkbox" id="active" name="active" value="1"
                            {{ $feedback->active == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

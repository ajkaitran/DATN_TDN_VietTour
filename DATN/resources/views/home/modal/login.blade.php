
<div class="modal fade" id="ModalLogin" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content bg_main">
        <div class="modal-header">
          <h1 class="modal-title title fs-5" id="exampleModalLabel">Đăng Nhập</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form_admin">
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
                <form action="{{ route('home.modal.postLogin') }}" method="post">
                    @csrf
                    <div class="form_group">
                        <label for="" class="form_label">Tài khoản</label>
                        <div class="form_input">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" class="form_item" name="login" placeholder="Tên người dùng hoặc abc@gmail.com" value="{{ old('login') }}">
                        </div>
                    </div>
            
                    <div class="form_group">
                        <label for="" class="form_label">Mật khẩu</label>
                        <div class="form_input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" class="form_item" name="password" placeholder="*********">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 p-3">Đăng Nhập</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
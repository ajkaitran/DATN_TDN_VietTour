
<div class="modal fade" id="ModalRegister" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content bg_main">
        <div class="modal-header">
          <h1 class="modal-title title fs-5" id="exampleModalLabel">Đăng Ký Tài Khoản</h1>
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
                <form action="{{ route('home.modal.postRegister') }}" method="post">
                    @csrf
                    <div class="form_group">
                        <label for="" class="form_label">Tài khoản</label>
                        <div class="form_input">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" class="form_item" name="username" placeholder="abc123" value="{{ old('username') }}">
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_label">Email</label>
                        <div class="form_input">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" class="form_item" name="email" placeholder="abc@gmail.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_label">Mật khẩu</label>
                        <div class="form_input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" class="form_item" name="password" placeholder="*********">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 p-3">Đăng Ký</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
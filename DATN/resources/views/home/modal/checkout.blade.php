
<div class="modal fade" id="ModalCheckout" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title title fs-5" id="exampleModalLabel">Thanh Toán COD</h1>
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
                <img src="{{ asset('images/COD.jpg') }}" alt="Ảnh mặc định">
                <h2 class="title mt-3">Chủ tài khoản: Trần Nam Hải</h2>
                <h3 class="title">Ngân hàng: MB bank</h3>
                <h3 class="title">Số tài khoản : 9704229209533615340</h3>
            </div>
        </div>
      </div>
    </div>
  </div>
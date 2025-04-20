<div class="modal fade " id="cart" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Giỏ hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="cart-items">
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ asset('images/avatar-01.jpg') }}" alt="Sản phẩm" class="me-3" width="50">
                        <div class="flex-grow-1">
                            <p class="mb-0">Tên sản phẩm</p>
                            <div class="input-group input-group-sm">

                                <input type="number" id="quantity" class="form-control-sm text-center quantity"
                                    value="1" step="1">
                            </div>

                        </div>
                        <button class="btn btn-danger btn-sm remove-item mt-3 pl-5"><i class="bi bi-trash"></i></button>
                        <input type="checkbox" class="ms-2 mt-3" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Đăng nhập</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password"
                            placeholder="Nhập mật khẩu" />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="/">RED&WAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach ($parentMenus as $parentMenu)
                        <li class="nav-item  dropdown">
                            <a class="nav-link 
                            @if ($childMenus->where('parent_id', $parentMenu->id)->isNotEmpty())
                            dropdown-toggle @endif" href="{{url($parentMenu->link) }}" id="dropdown{{ $parentMenu->id }} " role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $parentMenu->name }}
                            </a>
                            @if ($childMenus->where('parent_id', $parentMenu->id)->isNotEmpty())
                                <ul class="dropdown-menu" aria-labelledby="dropdown{{ $parentMenu->id }}">
                                    @foreach ($childMenus->where('parent_id', $parentMenu->id) as $childMenu)
                                        <li><a class="dropdown-item" href="{{ url($childMenu->link) }}">{{ $childMenu->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </li>
                    @endforeach 
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="sanPhamDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="sanPhamDropdown">
                            <li><a class="dropdown-item" href="#">Quần Jeans</a></li>
                            <li><a class="dropdown-item" href="#">Quần Short Jeans</a></li>
                            <li><a class="dropdown-item" href="#">Áo Khoác Jeans</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link  fw-bold " href="#">Hàng Mới</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Áo Nam</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Quần Nam</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">TechUrban</a></li>
                    <li class="nav-item"><a class="nav-link  fw-bold" href="#">GIÁ MỚI ĐÓN TẾT</a></li> --}}
                </ul>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Icon Tìm kiếm -->
                <a href="#" id="search-icon" class="text-dark fs-4">
                    <i class="bi bi-search"></i>
                </a>

                <!-- Ô nhập tìm kiếm (ẩn ban đầu) -->
                <input type="text" id="search-box" class="form-control w-50" placeholder="Nhập từ khóa tìm kiếm...">

                <!-- Icon Đăng nhập -->
                <a href="#" class="text-dark fs-4" data-bs-toggle="modal" data-bs-target="#login">
                    <i class="bi bi-person"></i>
                </a>
                {{-- login form --}}
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
                {{-- end login form --}}
                <!-- Icon Giỏ hàng -->
                <a href="#" class="text-dark fs-4 position-relative" data-bs-toggle="modal" data-bs-target="#cart">
                    <i class="bi bi-cart"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1 m-2">3</span>
                </a>
                <!-- Modal Giỏ hàng -->
                <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="cartModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cartModalLabel">Giỏ hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group" id="cart-items">
                                    <li class="list-group-item d-flex align-items-center">
                                        <img src="{{ asset('images/avatar-01.jpg') }}" alt="Sản phẩm" class="me-3"
                                            width="50">
                                        <div class="flex-grow-1">
                                            <p class="mb-0">Tên sản phẩm</p>
                                            <div class="input-group input-group-sm">
                                        
                                                <input type="number" id="quantity" class="form-control-sm text-center quantity" value="1"  step="1">
                                            </div>
                                                
                                        </div>
                                        <button class="btn btn-danger btn-sm remove-item mt-3 pl-5"><i
                                                class="bi bi-trash"></i></button>
                                        <input type="checkbox" class="ms-2 mt-3" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<script>
    document.getElementById("search-icon").addEventListener("click",  (e)=> {
        event.preventDefault();
        let searchBox = document.getElementById("search-box");
        if (searchBox.style.display === "none" || searchBox.style.display === "") {
            searchBox.style.display = "block";
            searchBox.style.opacity = "1";
            searchBox.focus();
        } else {
            searchBox.style.opacity = "0";
            setTimeout(() => { searchBox.style.display = "none"; }, 300);
        }
    });
    document.getElementById('quantity').addEventListener('input', (e) =>{
        e.target.value = Math.max(e.target.value, 1)
    });
</script>

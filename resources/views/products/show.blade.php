@extends('layout.app.app')
@section('title', 'Product Details')
@section('content')
    <!-- Container chính -->
    <div class="container my-4">
        <div class="row g-4">
            <!-- Cột hình ảnh sản phẩm -->
            <div class="col-12 col-md-6">
                <img src="{{ asset('images/product-01.jpg') }}" class="img-fluid rounded w-100 h-80" alt="Product Image" id="product-image">
            </div>
            <!-- Cột thông tin sản phẩm -->
            <div class="col-12 col-md-6">
                <h1 class="display-5 fw-bold">Product Name</h1>
                <p class="text-muted">Category: Electronics</p>
                <h3 class="text-success" id="product-price">$199.99</h3>
                <!-- Đánh giá sao trung bình -->
                <div class="star-rating mb-2">
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star"></i>
                    <span class="ms-2 text-muted">(4.0 - 25 reviews)</span>
                </div>
                <p class="mt-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <!-- Chọn biến thể: Màu sắc -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Color</label>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-secondary variant-btn color-btn active" onclick="selectVariant('color', 'Red', '$199.99', 'https://via.placeholder.com/500/FF0000')">Red</button>
                        <button class="btn btn-outline-secondary variant-btn color-btn" onclick="selectVariant('color', 'Blue', '$219.99', 'https://via.placeholder.com/500/0000FF')">Blue</button>
                        <button class="btn btn-outline-secondary variant-btn color-btn" onclick="selectVariant('color', 'Black', '$189.99', 'https://via.placeholder.com/500/000000')">Black</button>
                    </div>
                </div>
                <!-- Chọn biến thể: Kích thước -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Size</label>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-secondary variant-btn size-btn active" onclick="selectVariant('size', 'S')">S</button>
                        <button class="btn btn-outline-secondary variant-btn size-btn" onclick="selectVariant('size', 'M')">M</button>
                        <button class="btn btn-outline-secondary variant-btn size-btn" onclick="selectVariant('size', 'L')">L</button>
                    </div>
                </div>
                <!-- Số lượng -->
                <div class="input-group w-50 my-3">
                    <span class="input-group-text">Quantity</span>
                    <input type="number" class="form-control" id="quantity" value="1" min="1">
                </div>
                <!-- Nút hành động -->
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <button class="btn btn-primary btn-lg flex-grow-1">Add to Cart</button>
                    <button class="btn btn-outline-secondary btn-lg flex-grow-1">Add to Wishlist</button>
                </div>
            </div>
        </div>
        <!-- Thông tin bổ sung -->
        <div class="row mt-4">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="productTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <!-- Danh sách bình luận -->
                        <div class="mb-4">
                            <h5>Customer Reviews</h5>
                            <!-- Bình luận 1 -->
                            <div class="border-bottom py-3">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <strong>John Doe</strong>
                                    <span class="text-muted">Oct 10, 2023</span>
                                </div>
                                <div class="star-rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="mt-2">Great product! Works as expected, highly recommend.</p>
                            </div>
                            <!-- Bình luận 2 -->
                            <div class="border-bottom py-3">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <strong>Jane Smith</strong>
                                    <span class="text-muted">Oct 12, 2023</span>
                                </div>
                                <div class="star-rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="mt-2">Good quality, but shipping took a bit long.</p>
                            </div>
                        </div>
                        <!-- Form thêm bình luận -->
                        <h5>Write a Review</h5>
                        <form>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Your Rating</label>
                                <div class="star-rating" id="user-rating">
                                    <i class="fa fa-star" onclick="rate(this, 1)"></i>
                                    <i class="fa fa-star" onclick="rate(this, 2)"></i>
                                    <i class="fa fa-star" onclick="rate(this, 3)"></i>
                                    <i class="fa fa-star" onclick="rate(this, 4)"></i>
                                    <i class="fa fa-star" onclick="rate(this, 5)"></i>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Comment</label>
                                <textarea class="form-control" id="comment" rows="3" placeholder="Write your review here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- JavaScript cho đánh giá sao và chọn biến thể -->
    <script>
        let selectedVariants = { color: 'Red', size: 'S' }; // Biến thể mặc định

        function rate(star, rating) {
            const stars = star.parentElement.querySelectorAll('.fa-star');
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('checked');
                } else {
                    s.classList.remove('checked');
                }
            });
        }

        function selectVariant(type, value, price = null, image = null) {
            const buttons = document.querySelectorAll(`.${type}-btn`);
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Cập nhật biến thể đã chọn
            selectedVariants[type] = value;

            // Đếm số lượng biến thể đã chọn (color và size)
            const variantCount = Object.keys(selectedVariants).length;
            const quantityInput = document.getElementById('quantity');
            let currentQuantity = parseInt(quantityInput.value) || 1;

            // Cập nhật giá và hình ảnh nếu có
            if (price) {
                document.getElementById('product-price').textContent = price;
            }
            if (image) {
                document.getElementById('product-image').src = image;
            }
        }
    </script>

@endsection
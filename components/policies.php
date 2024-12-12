<section class="container py-5">
    <h2 class="text-center mb-5">Chính Sách Đồ</h2>

    <div id="policyCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            // Giả lập các chính sách đồ
            $policies = [
                ["id" => 1, "title" => "Chính Sách Bảo Hành", "desc" => "Chúng tôi cung cấp bảo hành cho tất cả các sản phẩm trong vòng 6 tháng kể từ ngày mua.", "image" => "https://example.com/warranty.jpg", "link" => "policy.php?id=1"],
                ["id" => 2, "title" => "Chính Sách Đổi Trả", "desc" => "Quý khách có thể đổi trả sản phẩm trong vòng 30 ngày nếu không hài lòng.", "image" => "https://example.com/return.jpg", "link" => "policy.php?id=2"],
                ["id" => 3, "title" => "Chính Sách Giao Hàng", "desc" => "Giao hàng miễn phí cho đơn hàng từ 500.000 VND trong phạm vi nội thành.", "image" => "https://example.com/delivery.jpg", "link" => "policy.php?id=3"],
                ["id" => 4, "title" => "Chính Sách Thanh Toán", "desc" => "Chúng tôi hỗ trợ nhiều hình thức thanh toán như thẻ tín dụng, chuyển khoản và thanh toán khi nhận hàng.", "image" => "https://example.com/payment.jpg", "link" => "policy.php?id=4"],
                ["id" => 5, "title" => "Chính Sách Bảo Mật", "desc" => "Chúng tôi cam kết bảo mật thông tin khách hàng 100% trong suốt quá trình giao dịch.", "image" => "https://example.com/security.jpg", "link" => "policy.php?id=5"]
            ];

            $chunks = array_chunk($policies, 4);
            $active = 'active';
            foreach ($chunks as $chunk) {
                echo '<div class="carousel-item ' . $active . '">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">';
                foreach ($chunk as $policy) {
                    echo '<div class="col">
                            <div class="card policy-card h-100">
                                <a href="' . $policy['link'] . '">
                                    <img src="' . $policy['image'] . '" class="card-img-top" alt="' . $policy['title'] . '">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate">' . $policy['title'] . '</h5>
                                    <p class="card-text flex-grow-1 text-truncate-2">' . $policy['desc'] . '</p>
                                    <a href="' . $policy['link'] . '" class="btn btn-info mt-2">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div></div>';
                $active = '';
            }
            ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#policyCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#policyCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
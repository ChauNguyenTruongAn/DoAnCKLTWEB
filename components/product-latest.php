<section class="container py-5">
    <h2 class="text-center mb-5">Sản Phẩm Mới Nhất</h2>

    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            // Truy vấn sản phẩm mới nhất
            $sql = "
                SELECT Ma_bo_sat, Ten_bo_sat, Gia, Mo_ta, 
                       (SELECT Duong_dan_anh 
                        FROM ANH 
                        WHERE ANH.Ma_bo_sat = BO_SAT.Ma_bo_sat 
                        LIMIT 1) AS Duong_dan_anh 
                FROM BO_SAT 
                ORDER BY Ngay_nhap DESC
                LIMIT 4
            ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $chunks = array_chunk($products, 4);
            $active = 'active';

            foreach ($chunks as $chunk) {
                echo '<div class="carousel-item ' . $active . '">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">';
                foreach ($chunk as $product) {
                    echo '<div class="col">
                            <div class="card product-card h-100">
                                <a href="product-detail.php?id=' . $product['Ma_bo_sat'] . '">
                                    <img src="' . $product['Duong_dan_anh'] . '" class="card-img-top" alt="' . $product['Ten_bo_sat'] . '">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate">' . $product['Ten_bo_sat'] . '</h5>
                                    <p class="card-text flex-grow-1 text-truncate-2">' . $product['Mo_ta'] . '</p>
                                    <p class="card-price">' . number_format($product['Gia'], 0, ',', '.') . ' VND</p>
                                    <a href="cart.php?add=' . $product['Ma_bo_sat'] . '" class="btn btn-success mt-2">Thêm vào Giỏ hàng</a>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div></div>';
                $active = ''; // Chỉ đặt `active` cho mục đầu tiên
            }
            ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
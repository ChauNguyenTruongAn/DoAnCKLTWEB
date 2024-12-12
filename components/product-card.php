<div class="col">
    <div class="card h-100 shadow-sm" style="cursor: pointer;"
        onclick="window.location.href='product.php?id=<?= $product['Ma_bo_sat'] ?>'">
        <!-- Hình ảnh sản phẩm -->
        <div class="card-img-top text-center" style="height: 180px; overflow: hidden;">
            <img src="<?= htmlspecialchars($product['Duong_dan_anh']) ?>" class="img-fluid"
                alt="<?= htmlspecialchars($product['Ten_bo_sat']) ?>" style="max-height: 100%; max-width: 100%;">
        </div>

        <!-- Nội dung sản phẩm -->
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-truncate" title="<?= htmlspecialchars($product['Ten_bo_sat']) ?>">
                <?= htmlspecialchars($product['Ten_bo_sat']) ?>
            </h5>
            <p class="card-text text-muted small"><?= htmlspecialchars($product['Ten_danh_muc']) ?></p>

            <!-- Giá và đánh giá -->
            <div class="mb-2">
                <p class="card-text fw-bold text-primary mb-1"><?= number_format($product['Gia'], 0, ',', '.') ?> VND
                </p>
                <div class="rating text-warning">
                    <?php
                    $ratingStars = $product['Sao'] ?? 0;
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $ratingStars) {
                            echo '<i class="bi bi-star-fill"></i>'; // Sao đầy
                        } elseif ($i - 0.5 <= $ratingStars) {
                            echo '<i class="bi bi-star-half"></i>'; // Sao nửa
                        } else {
                            echo '<i class="bi bi-star"></i>'; // Sao rỗng
                        }
                    }
                    ?>
                    <span class="small text-muted">(<?= htmlspecialchars($product['So_luong_danh_gia'] ?? 0) ?> đánh
                        giá)</span>
                </div>
            </div>

            <!-- Mô tả sản phẩm -->
            <p class="card-text small text-truncate-2" title="<?= htmlspecialchars($product['Mo_ta']) ?>">
                <?= htmlspecialchars($product['Mo_ta']) ?>
            </p>
        </div>

        <!-- Footer -->
        <div class="card-footer bg-white border-0 mt-auto">
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $product['Ma_bo_sat'] ?>">
                <button type="submit" class="btn btn-primary w-100">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>
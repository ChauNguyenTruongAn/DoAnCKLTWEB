<?php
include('config.php');  // Kết nối cơ sở dữ liệu

// Lấy id sản phẩm từ URL
$productId = isset($_GET['id']) ? $_GET['id'] : 1; // Mặc định là sản phẩm có id = 1

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$stmt = $conn->prepare("SELECT BO_SAT.Ma_bo_sat, BO_SAT.Ten_bo_sat, BO_SAT.Gia, BO_SAT.Mo_ta, 
                                DANH_MUC.Ten_danh_muc, ANH.Duong_dan_anh
                                FROM BO_SAT
                                JOIN DANH_MUC ON BO_SAT.Ma_danh_muc = DANH_MUC.Ma_danh_muc
                                JOIN ANH ON ANH.Ma_bo_sat = BO_SAT.Ma_bo_sat
                                WHERE BO_SAT.Ma_bo_sat = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Nếu không tìm thấy sản phẩm
if (!$product) {
    echo "<div class='container py-5'><h3 class='text-danger'>Sản phẩm không tồn tại!</h3></div>";
    exit;
}

// Lấy đánh giá của sản phẩm
$stmt = $conn->prepare("SELECT COALESCE(CEILING(AVG(DANH_GIA.Sao)), 0) AS Sao, 
                                COUNT(DANH_GIA.Ma_bo_sat) AS So_luong_danh_gia
                        FROM BO_SAT
                        LEFT JOIN DANH_GIA ON BO_SAT.Ma_bo_sat = DANH_GIA.Ma_bo_sat
                        WHERE BO_SAT.Ma_bo_sat = ?");
$stmt->execute([$productId]);
$rating = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy hình ảnh của sản phẩm
$stmt = $conn->prepare("SELECT Duong_dan_anh FROM ANH WHERE Ma_bo_sat = ?");
$stmt->execute([$productId]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy các bài đánh giá từ cơ sở dữ liệu
$stmt = $conn->prepare("SELECT DANH_GIA.Sao, DANH_GIA.Chi_tiet, KHACH_HANG.Ten, DANH_GIA.Ngay
                               FROM DANH_GIA 
                               JOIN KHACH_HANG ON KHACH_HANG.Ma_khach_hang = DANH_GIA.Ma_khach_hang
                               WHERE Ma_bo_sat = ?");
$stmt->execute([$productId]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<?php
include('components/header.php');
?>

<div class="container py-5">
    <?php include('components/breadcrumb-detail.php'); ?>
    <!-- Tiêu đề -->
    <h2 class="mb-4 text-primary fw-bold">
        <?php echo htmlspecialchars($product['Ten_bo_sat']); ?>
    </h2>

    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <div class="border mb-3" style="overflow: hidden;">
                <img id="main-image" src="<?php echo htmlspecialchars($images[0]['Duong_dan_anh']); ?>"
                    alt="<?php echo htmlspecialchars($product['Ten_bo_sat']); ?>" class="img-fluid rounded"
                    style="object-fit: cover; width: 100%; height: 400px;">
            </div>
            <!-- Thumbnail -->
            <div class="row">
                <?php foreach ($images as $image) { ?>
                    <div class="col-4 mb-2">
                        <img src="<?php echo htmlspecialchars($image['Duong_dan_anh']); ?>" alt="Thumbnail"
                            class="img-thumbnail thumbnail"
                            onclick="changeImage('<?php echo htmlspecialchars($image['Duong_dan_anh']); ?>')"
                            style="cursor: pointer;">
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="col-md-6">
            <!-- Mô tả -->
            <p class="fs-5 mb-4 text-muted">
                <strong>Mô tả:</strong> <?php echo htmlspecialchars($product['Mo_ta']); ?>
            </p>

            <!-- Giá -->
            <p class="fs-4 text-danger fw-bold">
                <?php echo number_format($product['Gia'], 0, ',', '.') . ' VND'; ?>
            </p>

            <!-- Đánh giá -->
            <div class="mb-4">
                <strong>Đánh giá:</strong>
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <span class="bi bi-star<?php echo $i <= $rating['Sao'] ? '-fill' : ''; ?> text-warning"></span>
                <?php } ?>
                <span class="text-muted">(<?php echo $rating['So_luong_danh_gia']; ?> đánh giá)</span>
            </div>

            <!-- Hành động -->
            <div class="d-flex align-items-center mb-3">
                <button class="btn btn-primary me-3 px-4">Thêm Vào Giỏ</button>
                <div class="input-group" style="max-width: 100px;">
                    <input type="number" class="form-control" value="1" min="1">
                </div>
            </div>
        </div>
    </div>

    <!-- Phần đánh giá và bình luận -->
    <div class="mt-5">
        <h4 class="text-primary">Đánh giá và Bình luận</h4>

        <div class="d-flex justify-content-between gap-4">
            <!-- Các bài đánh giá -->
            <div class="flex-fill">
                <h5 class="text-primary mb-3">Các Đánh Giá Của Khách Hàng</h5>
                <div class="list-group">
                    <?php foreach ($reviews as $review) { ?>
                        <div class="list-group-item">
                            <!-- Hiển thị sao đánh giá -->
                            <div class="mb-2">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <span
                                        class="bi bi-star<?php echo $i <= $review['Sao'] ? '-fill' : ''; ?> text-warning"></span>
                                <?php } ?>
                            </div>
                            <!-- Hiển thị tên người dùng và thời gian -->
                            <div class="d-flex justify-content-between mb-2">
                                <strong><?php echo htmlspecialchars($review['Ten']); ?></strong>
                                <small
                                    class="text-muted"><?php echo date('d/m/Y H:i', strtotime($review['Ngay'])); ?></small>
                            </div>
                            <!-- Hiển thị chi tiết bình luận -->
                            <p class="text-muted"><?php echo htmlspecialchars($review['Chi_tiet']); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Phần nhập đánh giá của người dùng -->
            <div class="flex-fill">
                <h5 class="text-primary mb-3">Thêm Đánh Giá Của Bạn</h5>

                <div class="review-component">
                    <h3>Gửi Đánh Giá</h3>
                    <form action="process_review.php" method="POST">
                        <div class="form-group">
                            <label>Đánh giá sao</label>
                            <div class="rating-group">
                                <input type="radio" name="rating" id="star-5" value="5" required>
                                <label for="star-5">&#9733;</label>
                                <input type="radio" name="rating" id="star-4" value="4">
                                <label for="star-4">&#9733;</label>
                                <input type="radio" name="rating" id="star-3" value="3">
                                <label for="star-3">&#9733;</label>
                                <input type="radio" name="rating" id="star-2" value="2">
                                <label for="star-2">&#9733;</label>
                                <input type="radio" name="rating" id="star-1" value="1">
                                <label for="star-1">&#9733;</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Bình luận</label>
                            <textarea name="comment" id="comment" rows="4" placeholder="Nhập bình luận của bạn..."
                                required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Gửi Đánh Giá</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(imageSrc) {
        document.getElementById('main-image').src = imageSrc;
    }
</script>

<?php include('components/footer.php'); ?>
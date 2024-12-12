<?php
include('config.php');

// Xử lý thêm sản phẩm khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_bo_sat = $_POST['ten_bo_sat'];
    $gia = $_POST['gia'];
    $mo_ta = $_POST['mo_ta'];
    $ma_danh_muc = $_POST['ma_danh_muc'];

    try {
        $sql = "INSERT INTO BO_SAT (Ten_bo_sat, Gia, Mo_ta, Ma_danh_muc, Ngay_nhap) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ten_bo_sat, $gia, $mo_ta, $ma_danh_muc]);

        echo "<script>alert('Sản phẩm đã được thêm!'); window.location = 'product-management.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi: " . $e->getMessage() . "');</script>";
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-5">
    <h2 class="text-center mb-4">Thêm Sản Phẩm Mới</h2>
    <form action="add-product.php" method="POST">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ten_bo_sat">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="ten_bo_sat" name="ten_bo_sat" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gia">Giá</label>
                    <input type="number" class="form-control" id="gia" name="gia" step="0.01" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="mo_ta">Mô tả</label>
            <textarea class="form-control" id="mo_ta" name="mo_ta" rows="4" placeholder="Mô tả sản phẩm..."></textarea>
        </div>

        <div class="form-group mb-4">
            <label for="ma_danh_muc">Danh mục</label>
            <select class="form-control" id="ma_danh_muc" name="ma_danh_muc" required>
                <option value="" disabled selected>Chọn danh mục</option>
                <?php
                // Lấy danh sách danh mục
                $categoryStmt = $conn->prepare("SELECT * FROM DANH_MUC");
                $categoryStmt->execute();
                $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) {
                    echo "<option value='{$category['Ma_danh_muc']}'>{$category['Ten_danh_muc']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group text-center mb-4">
            <button type="submit" class="btn btn-success btn-lg">Thêm sản phẩm</button>
        </div>

        <!-- Nút quay lại -->
        <div class="form-group text-center">
            <a href="products.php" class="btn btn-secondary btn-lg">Quay lại</a>
        </div>
    </form>
</div>

<!-- Thêm thư viện Bootstrap JS nếu cần -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
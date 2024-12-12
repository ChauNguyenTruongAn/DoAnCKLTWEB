<?php
include('config.php');

// Lấy id sản phẩm cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm hiện tại
    $stmt = $conn->prepare("SELECT * FROM BO_SAT WHERE Ma_bo_sat = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu không tìm thấy sản phẩm
    if (!$product) {
        echo "<script>alert('Sản phẩm không tồn tại!'); window.location = 'products.php';</script>";
        exit;
    }

    // Xử lý sửa sản phẩm khi form được gửi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ten_bo_sat = $_POST['ten_bo_sat'];
        $gia = $_POST['gia'];
        $mo_ta = $_POST['mo_ta'];
        $ma_danh_muc = $_POST['ma_danh_muc'];

        try {
            $sql = "UPDATE BO_SAT SET Ten_bo_sat = ?, Gia = ?, Mo_ta = ?, Ma_danh_muc = ? WHERE Ma_bo_sat = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ten_bo_sat, $gia, $mo_ta, $ma_danh_muc, $id]);

            echo "<script>alert('Sản phẩm đã được cập nhật!'); window.location = 'product-management.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Lỗi: " . $e->getMessage() . "');</script>";
        }
    }
} else {
    echo "<script>alert('ID sản phẩm không hợp lệ!'); window.location = 'products.php';</script>";
}
?>

<!-- Giao diện đẹp hơn -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="text-center mb-4">Chỉnh Sửa Sản Phẩm</h2>
    <form action="edit-product.php?id=<?php echo $product['Ma_bo_sat']; ?>" method="POST">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ten_bo_sat">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="ten_bo_sat" name="ten_bo_sat"
                        value="<?php echo $product['Ten_bo_sat']; ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gia">Giá</label>
                    <input type="number" class="form-control" id="gia" name="gia" value="<?php echo $product['Gia']; ?>"
                        step="0.01" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="mo_ta">Mô tả</label>
            <textarea class="form-control" id="mo_ta" name="mo_ta" rows="4"><?php echo $product['Mo_ta']; ?></textarea>
        </div>

        <div class="form-group mb-4">
            <label for="ma_danh_muc">Danh mục</label>
            <select class="form-control" id="ma_danh_muc" name="ma_danh_muc" required>
                <?php
                // Lấy danh sách danh mục
                $categoryStmt = $conn->prepare("SELECT * FROM DANH_MUC");
                $categoryStmt->execute();
                $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) {
                    $selected = ($category['Ma_danh_muc'] == $product['Ma_danh_muc']) ? 'selected' : '';
                    echo "<option value='{$category['Ma_danh_muc']}' $selected>{$category['Ten_danh_muc']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg">Cập nhật sản phẩm</button>
        </div>

        <!-- Nút quay lại -->
        <div class="form-group text-center mt-4">
            <a href="products.php" class="btn btn-secondary btn-lg">Quay lại</a>
        </div>
    </form>
</div>

<!-- Thêm thư viện Bootstrap JS nếu cần -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
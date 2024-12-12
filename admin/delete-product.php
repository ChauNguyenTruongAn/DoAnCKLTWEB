<?php
include('config.php');

// Lấy id sản phẩm cần xóa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Xóa sản phẩm
        $sql = "DELETE FROM BO_SAT WHERE Ma_bo_sat = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        echo "<script>alert('Sản phẩm đã được xóa!'); window.location = 'product-management.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('ID sản phẩm không hợp lệ!'); window.location = 'products.php';</script>";
}
?>
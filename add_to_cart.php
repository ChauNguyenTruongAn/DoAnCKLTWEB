<?php
session_start();
include("config.php");

// Kiểm tra nếu có sản phẩm được gửi từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $cartId = $_SESSION['Ma_gio_hang'];

    // Kiểm tra xem sản phẩm đã có trong giỏ chưa
    $stmt = $conn->prepare("SELECT * FROM CHI_TIET_GIO_HANG WHERE Ma_bo_sat = ? AND Ma_gio_hang = ?");
    $stmt->execute([$productId, $cartId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Nếu đã có, cập nhật số lượng
        $stmt = $conn->prepare("UPDATE CHI_TIET_GIO_HANG SET So_luong = So_luong + 1 WHERE Ma_bo_sat = ? AND Ma_gio_hang = ?");
        $stmt->execute([$productId, $cartId]);
        $_SESSION['cart_message'] = 'Sản phẩm đã được thêm vào giỏ hàng!';
    } else {
        // Nếu chưa có, thêm mới vào giỏ hàng
        $stmt = $conn->prepare("INSERT INTO CHI_TIET_GIO_HANG (Ma_bo_sat, Ma_gio_hang, So_luong) VALUES (?, ?, ?)");
        $quantity = 1; // Mặc định là 1
        $stmt->execute([$productId, $cartId, $quantity]);
        $_SESSION['cart_message'] = 'Sản phẩm đã được thêm vào giỏ hàng!';
    }

    // Đóng câu lệnh và chuyển hướng về trang trước
    header("Location: " . $_SERVER['HTTP_REFERER']); // Quay lại trang trước
    exit();
}
?>
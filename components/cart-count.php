<?php
session_start();
include("config.php");

// Kiểm tra người dùng đã đăng nhập chưa
if (isset($_SESSION['Ten_dang_nhap'])) {
    $customerId = $_SESSION['Ma_khach_hang'];

    // Truy vấn số lượng sản phẩm trong giỏ hàng của người dùng
    $stmt = $conn->prepare("SELECT COUNT(*) FROM CHI_TIET_GIO_HANG WHERE Ma_gio_hang = (SELECT Ma_gio_hang FROM GIO_HANG WHERE Ma_khach_hang = ?)");
    $stmt->bindParam(1, $customerId, PDO::PARAM_INT);
    $stmt->execute();

    // Lấy số lượng sản phẩm trong giỏ hàng
    $cartCount = $stmt->fetchColumn();

    // Trả về số lượng giỏ hàng
    echo $cartCount;
} else {
    // Nếu người dùng chưa đăng nhập, giỏ hàng là 0
    echo 0;
}
?>
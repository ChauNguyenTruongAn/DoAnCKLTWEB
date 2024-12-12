<?php
session_start();

include('config.php');

if (!isset($_SESSION['Ma_khach_hang'])) {
    echo "Vui lòng đăng nhập để gửi đánh giá!";
    header("Location: login.php");
    exit;
}

$productId = isset($_GET['id']) ? $_GET['id'] : 1;

$rating = isset($_POST['rating']) ? $_POST['rating'] : 0;
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

if ($rating && $comment) {
    try {
        $stmt = $conn->prepare("INSERT INTO DANH_GIA (Sao, Chi_tiet, Ma_bo_sat, Ma_khach_hang) 
                                VALUES (?, ?, ?, ?)");
        $stmt->execute([$rating, $comment, $productId, $_SESSION['Ma_khach_hang']]);

        header("Location: product.php?id=" . $productId);
        exit;
    } catch (PDOException $e) {
        echo "Có lỗi xảy ra khi thêm đánh giá: " . $e->getMessage();
    }
} else {
    echo "Vui lòng chọn sao và nhập bình luận!";
}
?>
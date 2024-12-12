<?php
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 12; // số sản phẩm mỗi trang
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
